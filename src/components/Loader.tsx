"use client";

import { usePathname } from "next/navigation";
import { useEffect, useState } from "react";

export function Loader() {
  const pathname = usePathname();
  const [visible, setVisible] = useState(true);
  const [fading, setFading] = useState(false);

  useEffect(() => {
    setVisible(true);
    setFading(false);

    const fadeTimer = window.setTimeout(() => setFading(true), 550);
    const hideTimer = window.setTimeout(() => setVisible(false), 1100);

    return () => {
      window.clearTimeout(fadeTimer);
      window.clearTimeout(hideTimer);
    };
  }, [pathname]);

  if (!visible) return null;

  return (
    <div
      className={`fixed inset-0 z-[100] flex items-center justify-center bg-[#001038] transition-opacity duration-700 ease-[cubic-bezier(0.22,1,0.36,1)] ${
        fading ? "pointer-events-none opacity-0" : "opacity-100"
      }`}
    >
      <div className="relative flex items-center justify-center">
        <div className="absolute h-32 w-32 animate-pulse rounded-full bg-[#63E5C5] opacity-20 blur-2xl" />
        {/* eslint-disable-next-line @next/next/no-img-element */}
        <img
          src="/botonnucleo.png"
          alt="Loading"
          className="h-40 w-40 animate-spin object-contain [animation-duration:1.1s]"
        />
      </div>
    </div>
  );
}
