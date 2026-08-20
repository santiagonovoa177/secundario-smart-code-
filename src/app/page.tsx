import Link from "next/link";
import { PingPongVideo } from "@/components/PingPongVideo";
import { home } from "@/lib/content";

export default function HomePage() {
  return (
    <main className="relative z-0 flex-1">
      <section className="relative flex min-h-[100dvh] items-center justify-center overflow-hidden">
        <PingPongVideo
          src="/images/homeVideo.mp4"
          reverseSrc="/images/homeVideo-reverse.mp4"
          className="absolute inset-0 h-full w-full overflow-hidden"
        />
        <div className="absolute inset-0 bg-black/40" />
        <div className="relative z-10 mx-auto max-w-5xl px-6 text-center">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img
            src="/logo.png"
            alt="Smart Code Núcleo"
            className="mx-auto mb-8 h-20 w-auto object-contain animate-fade-up md:h-28"
          />
          <h1 className="text-4xl font-extrabold tracking-tight text-white uppercase md:text-6xl animate-fade-up-delay">
            {home.heroTitle}
          </h1>
          <div className="mt-10 flex flex-wrap items-center justify-center gap-4 animate-fade-up-delay-2">
            <Link
              href="/solutions"
              className="rounded-full bg-[#63C6AD] px-8 py-3 text-sm font-semibold text-[#001038] transition duration-300 hover:bg-[#63E5C5]"
            >
              About Us
            </Link>
            <Link
              href="/lestconnect"
              className="rounded-full border border-white/30 bg-white/10 px-8 py-3 text-sm font-semibold text-white backdrop-blur-md transition duration-300 hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
            >
              Contact
            </Link>
          </div>
        </div>
      </section>

      <section className="px-6 py-20">
        <div className="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 md:grid-cols-2">
          <div className="animate-fade-up">
            <div className="mx-auto aspect-square w-full max-w-md overflow-hidden">
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img
                src="/images/ball.webp"
                alt="Smart Code nucleus"
                width={448}
                height={448}
                className="h-full w-full object-contain"
              />
            </div>
          </div>
          <div className="animate-fade-up-delay">
            <h2 className="text-3xl font-bold text-white uppercase md:text-5xl">
              {home.sectionTitle}
            </h2>
            <p className="mt-6 text-lg text-white/90">
              <strong className="text-[#63C6AD]">Smart Code Núcleo</strong> is
              the digital nucleus behind high-end, solid, secure, modular, and
              future-ready technology.
            </p>
            {home.paragraphs.map((p) => (
              <p key={p.slice(0, 32)} className="mt-4 text-white/80">
                {p}
              </p>
            ))}
            <Link
              href="/lestconnect"
              className="mt-8 inline-flex rounded-full border border-white/30 px-6 py-3 text-sm text-white transition duration-300 hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
            >
              Contact
            </Link>
          </div>
        </div>
      </section>
    </main>
  );
}
