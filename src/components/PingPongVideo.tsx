"use client";

import { useEffect, useRef } from "react";

type Props = {
  src: string;
  reverseSrc?: string;
  className?: string;
};

export function PingPongVideo({ src, reverseSrc, className }: Props) {
  const fwdRef = useRef<HTMLVideoElement>(null);
  const revRef = useRef<HTMLVideoElement>(null);

  useEffect(() => {
    const fwd = fwdRef.current;
    const rev = revRef.current;
    if (!fwd) return;

    const hasReverse = Boolean(reverseSrc && rev);
    let cancelled = false;
    let phase: "forward" | "reverse" = "forward";
    let primed = false;
    let raf = 0;

    const bringFront = (el: HTMLVideoElement) => {
      el.style.zIndex = "2";
    };

    const sendBack = (el: HTMLVideoElement) => {
      el.style.zIndex = "1";
    };

    const safePlay = (el: HTMLVideoElement) => {
      const p = el.play();
      if (p && typeof p.catch === "function") p.catch(() => {});
    };

    const left = (el: HTMLVideoElement) => {
      const d = el.duration;
      if (!d || !Number.isFinite(d)) return Infinity;
      return Math.max(0, d - el.currentTime);
    };

    const active = () => (phase === "forward" ? fwd : rev)!;
    const standby = () => (phase === "forward" ? rev : fwd);

    const tick = () => {
      if (cancelled) return;
      raf = requestAnimationFrame(tick);
      if (document.hidden) return;

      const cur = active();
      const nxt = standby();
      if (!cur) return;

      const remain = left(cur);
      if (!Number.isFinite(remain)) return;

      if (hasReverse && nxt && !primed && remain <= 0.22) {
        primed = true;
        try {
          nxt.currentTime = 0;
        } catch {
          /* ignore */
        }
        safePlay(nxt);
      }

      if (hasReverse && nxt && remain <= 1 / 28) {
        if (!primed) {
          try {
            nxt.currentTime = 0;
          } catch {
            /* ignore */
          }
          safePlay(nxt);
        }
        bringFront(nxt);
        sendBack(cur);
        cur.pause();
        try {
          cur.currentTime = 0;
        } catch {
          /* ignore */
        }
        phase = phase === "forward" ? "reverse" : "forward";
        primed = false;
      }
    };

    fwd.muted = true;
    fwd.defaultMuted = true;
    fwd.playsInline = true;
    fwd.loop = !hasReverse;
    bringFront(fwd);

    if (rev) {
      rev.muted = true;
      rev.defaultMuted = true;
      rev.playsInline = true;
      rev.loop = false;
      sendBack(rev);
    }

    const start = () => {
      if (cancelled) return;
      bringFront(fwd);
      if (rev) sendBack(rev);
      safePlay(fwd);
      if (hasReverse) raf = requestAnimationFrame(tick);
    };

    if (fwd.readyState >= 2) start();
    else fwd.addEventListener("loadeddata", start, { once: true });

    return () => {
      cancelled = true;
      cancelAnimationFrame(raf);
      fwd.removeEventListener("loadeddata", start);
    };
  }, [src, reverseSrc]);

  return (
    <div
      className={className ?? "absolute inset-0 h-full w-full"}
      aria-hidden
    >
      <video
        ref={fwdRef}
        className="absolute inset-0 z-[2] h-full w-full object-cover"
        muted
        playsInline
        autoPlay
        preload="auto"
        poster="/images/ball.webp"
      >
        <source src={src} type="video/mp4" />
      </video>
      {reverseSrc ? (
        <video
          ref={revRef}
          className="absolute inset-0 z-[1] h-full w-full object-cover"
          muted
          playsInline
          preload="auto"
        >
          <source src={reverseSrc} type="video/mp4" />
        </video>
      ) : null}
    </div>
  );
}
