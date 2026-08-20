import { PageShell, SectionHeading } from "@/components/PageShell";
import { news } from "@/lib/content";

export default function NewsPage() {
  return (
    <PageShell>
      <SectionHeading title={news.title} subtitle={news.subtitle} />
      <div className="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
        {news.items.map((item, i) => (
          <article
            key={item.title}
            className="flex flex-col overflow-hidden rounded-2xl border border-white/15 bg-white/5 backdrop-blur-md animate-fade-up"
            style={{ animationDelay: `${i * 90}ms` }}
          >
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img
              src={item.img}
              alt={item.title}
              className="h-44 w-full object-cover"
            />
            <div className="flex flex-1 flex-col p-5">
              <h3 className="text-lg font-bold leading-snug text-white whitespace-pre-line">
                {item.title}
              </h3>
              <p className="mt-3 flex-1 text-sm text-white/75">{item.excerpt}</p>
              <p className="mt-4 text-xs text-white/45">{item.date}</p>
            </div>
          </article>
        ))}
      </div>
    </PageShell>
  );
}
