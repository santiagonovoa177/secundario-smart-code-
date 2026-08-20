"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";
import { navLinks } from "@/lib/content";

export function Header() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  return (
    <header className="fixed top-0 left-0 z-50 flex w-full justify-center">
      <div className="mt-3 w-full max-w-7xl px-6 max-md:mt-2 max-md:px-4">
        {/* Top bar */}
        <div
          className={`mx-auto flex items-center gap-4 rounded-full border border-white/20 bg-white/10 px-5 py-3 shadow-[0_10px_30px_rgba(0,0,0,0.25)] backdrop-blur-[18px] max-md:w-full max-md:justify-between max-md:px-4 max-md:py-2.5 md:w-max md:max-w-full md:justify-center`}
        >
          <Link href="/" className="flex shrink-0 items-center" onClick={() => setOpen(false)}>
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img
              src="/logo.png"
              alt="Smart Code Núcleo"
              className="h-11 w-auto object-contain md:h-14"
            />
          </Link>

          <nav className="hidden items-center justify-center gap-2 md:flex">
            {navLinks.map((link) => {
              const active = pathname === link.href;
              return (
                <Link
                  key={link.href}
                  href={link.href}
                  className={`whitespace-nowrap rounded-full border px-4 py-2 text-[13px] text-white transition-all duration-300 hover:border-[#63C6AD] hover:bg-[#63C6AD] hover:text-[#062A45] ${
                    active
                      ? "border-[#63C6AD] bg-[#63C6AD] text-[#062A45]"
                      : "border-white/30"
                  }`}
                >
                  {link.label}
                </Link>
              );
            })}
          </nav>

          <button
            type="button"
            aria-label={open ? "Close menu" : "Open menu"}
            aria-expanded={open}
            className="relative flex h-9 w-9 shrink-0 items-center justify-center md:hidden"
            onClick={() => setOpen((v) => !v)}
          >
            {open ? (
              <span className="relative block h-5 w-5">
                <span className="absolute top-1/2 left-0 h-0.5 w-5 -translate-y-1/2 rotate-45 bg-white" />
                <span className="absolute top-1/2 left-0 h-0.5 w-5 -translate-y-1/2 -rotate-45 bg-white" />
              </span>
            ) : (
              <span className="relative block h-5 w-6">
                <span className="absolute top-0 left-0 h-0.5 w-6 bg-white" />
                <span className="absolute top-1/2 left-0 h-0.5 w-6 -translate-y-1/2 bg-white" />
                <span className="absolute bottom-0 left-0 h-0.5 w-6 bg-white" />
              </span>
            )}
          </button>
        </div>

        {/* Mobile dropdown — glass panel like reference */}
        <div
          className={`mt-3 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] md:hidden ${
            open ? "max-h-[520px] translate-y-0 opacity-100" : "max-h-0 -translate-y-1 opacity-0"
          }`}
        >
          <nav
            className="w-full rounded-[1.35rem] border border-white/20 bg-white/10 px-6 py-5 shadow-[0_10px_30px_rgba(0,0,0,0.25)] backdrop-blur-[18px]"
            aria-label="Mobile"
          >
            <ul className="flex flex-col gap-5">
              {navLinks.map((link) => {
                const active = pathname === link.href;
                return (
                  <li key={link.href}>
                    <Link
                      href={link.href}
                      onClick={() => setOpen(false)}
                      className={`block text-left text-[17px] leading-none transition-colors ${
                        active ? "text-[#63C6AD]" : "text-white hover:text-[#63E5C5]"
                      }`}
                    >
                      {link.label}
                    </Link>
                  </li>
                );
              })}
            </ul>
          </nav>
        </div>
      </div>
    </header>
  );
}
