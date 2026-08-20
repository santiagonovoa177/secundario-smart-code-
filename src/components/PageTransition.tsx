"use client";

import { usePathname } from "next/navigation";
import { useEffect, useState, type ReactNode } from "react";

export function PageTransition({ children }: { children: ReactNode }) {
  const pathname = usePathname();
  const [show, setShow] = useState(true);
  const [key, setKey] = useState(pathname);

  useEffect(() => {
    setShow(false);
    const t = window.setTimeout(() => {
      setKey(pathname);
      setShow(true);
    }, 90);
    return () => window.clearTimeout(t);
  }, [pathname]);

  return (
    <div
      key={key}
      className={`flex min-h-full flex-1 flex-col transition-[opacity,transform] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] ${
        show ? "translate-y-0 opacity-100" : "translate-y-1 opacity-0"
      }`}
    >
      {children}
    </div>
  );
}
