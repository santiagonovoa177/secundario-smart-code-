import Link from "next/link";
import { ConnectForm } from "@/components/ConnectForm";
import { PageShell, SectionHeading } from "@/components/PageShell";
import { demo } from "@/lib/content";

export default function DemoPage() {
  return (
    <PageShell>
      <SectionHeading title={demo.title} subtitle={demo.subtitle} />
      <p className="mx-auto max-w-3xl text-center text-lg text-white/85 animate-fade-up">
        {demo.text}
      </p>
      <ConnectForm />
      <div className="mt-10 text-center animate-fade-up-delay">
        <Link
          href="/solutions"
          className="text-sm text-white/70 transition hover:text-[#63E5C5]"
        >
          Or explore our solutions →
        </Link>
      </div>
    </PageShell>
  );
}
