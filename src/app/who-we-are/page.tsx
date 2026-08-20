import { PageShell, SectionHeading } from "@/components/PageShell";
import { whoWeAre } from "@/lib/content";

export default function WhoWeArePage() {
  return (
    <PageShell>
      <SectionHeading title={whoWeAre.title} subtitle={whoWeAre.question} />
      <div className="mt-12 grid grid-cols-1 items-start gap-10 md:grid-cols-2">
        <div className="animate-fade-up">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img
            src={whoWeAre.image}
            alt="Smart Code Núcleo team and platform"
            className="h-auto w-full rounded-2xl border border-white/15"
          />
        </div>
        <div className="animate-fade-up-delay">
          {whoWeAre.body.map((p) => (
            <p key={p.slice(0, 40)} className="mb-4 text-white/85">
              {p}
            </p>
          ))}
          <h3 className="mt-8 text-xl font-bold tracking-widest text-[#63C6AD]/90">
            VISION
          </h3>
          <p className="mt-2 text-white/85">{whoWeAre.vision}</p>
          <h3 className="mt-6 text-xl font-bold tracking-widest text-[#63C6AD]/90">
            MISSION
          </h3>
          <p className="mt-2 text-white/85">{whoWeAre.mission}</p>
        </div>
      </div>
    </PageShell>
  );
}
