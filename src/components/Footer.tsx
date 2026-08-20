import { site } from "@/lib/content";

export function Footer() {
  return (
    <footer className="mt-auto bg-[#001038] px-6 py-10">
      <div className="mx-auto mb-7 flex max-w-3xl flex-wrap items-center justify-center gap-x-12 gap-y-4 text-sm text-white/90">
        <span className="inline-flex items-center gap-2">
          <span className="text-[#63C6AD]" aria-hidden>
            ⌖
          </span>
          Uruguay
        </span>
        <a
          href={`mailto:${site.email}`}
          className="inline-flex items-center gap-2 transition hover:text-[#63C6AD]"
        >
          <span className="text-[#63C6AD]" aria-hidden>
            ✉
          </span>
          {site.email}
        </a>
      </div>

      <div className="mx-auto mb-7 h-px max-w-3xl bg-white/20" />

      <div className="mx-auto flex max-w-3xl flex-col items-center gap-5 text-center">
        <div className="flex justify-center gap-4">
          <a
            href={site.social.linkedin}
            target="_blank"
            rel="noopener noreferrer"
            aria-label="LinkedIn"
            className="flex h-10 w-10 items-center justify-center rounded-full border border-white/35 text-white transition hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
          >
            in
          </a>
          <a
            href="https://www.facebook.com/"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Facebook"
            className="flex h-10 w-10 items-center justify-center rounded-full border border-white/35 text-white transition hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
          >
            f
          </a>
          <a
            href="https://www.twitter.com/"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Twitter"
            className="flex h-10 w-10 items-center justify-center rounded-full border border-white/35 text-white transition hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
          >
            𝕏
          </a>
          <a
            href={site.social.instagram}
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Instagram"
            className="flex h-10 w-10 items-center justify-center rounded-full border border-white/35 text-white transition hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#001038]"
          >
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img src="/instagram.png" alt="" className="h-4 w-4 object-contain" />
          </a>
        </div>
        <p className="text-sm text-white/55">© 2026 Smart Code Núcleo. All rights reserved.</p>
      </div>
    </footer>
  );
}
