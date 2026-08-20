import { FeatureGrid } from "@/components/FeatureGrid";
import { PageShell, SectionHeading } from "@/components/PageShell";

export default function SolutionsPage() {
  return (
    <PageShell>
      <SectionHeading
        title="About Us"
        subtitle="Solutions built for autonomy, scale, and long-term growth"
      />
      <FeatureGrid />
    </PageShell>
  );
}
