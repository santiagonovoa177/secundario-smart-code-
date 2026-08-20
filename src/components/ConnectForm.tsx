"use client";

import { FormEvent, useState } from "react";

export function ConnectForm() {
  const [sent, setSent] = useState(false);

  function onSubmit(e: FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setSent(true);
  }

  if (sent) {
    return (
      <p className="mt-8 text-center text-lg text-[#63E5C5]">
        Thanks! We will reach out.
      </p>
    );
  }

  return (
    <form className="mx-auto mt-8 max-w-2xl" onSubmit={onSubmit}>
      <label htmlFor="email" className="sr-only">
        Business email
      </label>
      <div className="relative">
        <span className="pointer-events-none absolute top-1/2 left-4 -translate-y-1/2 text-[#63C6AD]">
          ✉
        </span>
        <input
          id="email"
          name="email"
          type="email"
          required
          placeholder="Enter your business e-mail"
          className="w-full rounded-full border border-white/20 bg-[#0f162f]/90 py-4 pr-36 pl-12 text-white outline-none transition focus:border-[#63C6AD]"
        />
        <button
          type="submit"
          className="absolute top-1/2 right-2 -translate-y-1/2 rounded-full bg-[#63C6AD] px-5 py-2.5 text-sm font-semibold text-[#001038] transition hover:bg-[#63E5C5]"
        >
          Connect
        </button>
      </div>
    </form>
  );
}
