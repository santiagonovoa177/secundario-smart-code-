import { PageShell, SectionHeading } from "@/components/PageShell";
import { partners } from "@/lib/content";

export default function PartnersPage() {
  return (
    <PageShell>
      <SectionHeading title={partners.title} subtitle={partners.subtitle} />
      <div className="mt-8 grid grid-cols-1 gap-5 md:grid-cols-3">
        {partners.images.map((img, i) => (
          <div
            key={img}
            className="relative min-h-[220px] overflow-hidden rounded-2xl border border-white/15 animate-fade-up"
            style={{ animationDelay: `${i * 100}ms` }}
          >
            <div
              className="absolute inset-0 bg-cover bg-center"
              style={{ backgroundImage: `url(${img})` }}
            />
            <div className="absolute inset-0 bg-gradient-to-b from-black/5 via-black/20 to-black/50" />
          </div>
        ))}
      </div>
      <p className="mt-12 text-center text-2xl font-semibold tracking-wide text-white uppercase md:text-3xl animate-fade-up-delay">
        {partners.cta}
      </p>
    </PageShell>
  );
}
