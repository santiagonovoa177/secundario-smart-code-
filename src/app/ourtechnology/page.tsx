import { FeatureGrid } from "@/components/FeatureGrid";
import { PageShell, SectionHeading } from "@/components/PageShell";
import { solutions, technology } from "@/lib/content";

export default function OurTechnologyPage() {
  return (
    <PageShell>
      <SectionHeading title={technology.title} subtitle={technology.subtitle} />
      <p className="mx-auto mb-12 max-w-3xl text-center text-lg text-white/85 animate-fade-up">
        {technology.lead}
      </p>
      <div className="mb-14 grid grid-cols-1 gap-6 md:grid-cols-3">
        {technology.points.map((point, i) => (
          <div
            key={point.title}
            className="rounded-2xl border border-white/15 bg-white/5 p-6 backdrop-blur-md animate-fade-up"
            style={{ animationDelay: `${i * 80}ms` }}
          >
            <h3 className="text-xl font-bold text-[#63C6AD]">{point.title}</h3>
            <p className="mt-3 text-sm text-white/80">{point.text}</p>
          </div>
        ))}
      </div>
      <FeatureGrid items={solutions.slice(0, 3)} />
    </PageShell>
  );
}
