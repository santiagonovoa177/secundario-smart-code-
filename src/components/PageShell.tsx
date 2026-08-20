import type { ReactNode } from "react";

export function PageShell({
  children,
  className = "",
}: {
  children: ReactNode;
  className?: string;
}) {
  return (
    <main
      className={`relative z-0 flex-1 px-6 pt-28 pb-20 md:pt-32 ${className}`}
    >
      <div className="mx-auto w-full max-w-7xl">{children}</div>
    </main>
  );
}

export function SectionHeading({
  title,
  subtitle,
}: {
  title: string;
  subtitle?: string;
}) {
  return (
    <div className="mb-10 text-center">
      <h1 className="text-3xl font-bold tracking-tight text-white uppercase md:text-5xl animate-fade-up">
        {title}
      </h1>
      {subtitle ? (
        <p className="mx-auto mt-4 max-w-3xl text-xl font-extrabold tracking-wide text-[#63C6AD]/75 uppercase md:text-2xl animate-fade-up-delay">
          {subtitle}
        </p>
      ) : null}
    </div>
  );
}
