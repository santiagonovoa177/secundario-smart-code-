import { ConnectForm } from "@/components/ConnectForm";
import { PageShell, SectionHeading } from "@/components/PageShell";
import { connect, site } from "@/lib/content";

export default function LetsConnectPage() {
  return (
    <PageShell>
      <SectionHeading title={connect.title} subtitle={connect.subtitle} />
      <div className="mx-auto max-w-3xl space-y-1 text-center text-white/85 animate-fade-up">
        {connect.lines.map((line) => (
          <p key={line}>{line}</p>
        ))}
        <p className="pt-4">
          <a
            href={`mailto:${site.email}`}
            className="text-[#63C6AD] transition hover:text-[#63E5C5]"
          >
            {site.email}
          </a>
        </p>
      </div>
      <ConnectForm />
    </PageShell>
  );
}
