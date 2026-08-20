import { solutions } from "@/lib/content";

export function FeatureGrid({ items = solutions }: { items?: typeof solutions }) {
  return (
    <div className="grid grid-cols-1 gap-5 md:grid-cols-3">
      {items.map((item, index) => (
        <article
          key={item.title}
          className="group relative min-h-[280px] overflow-hidden rounded-2xl border border-white/15 shadow-lg animate-fade-up"
          style={{ animationDelay: `${index * 80}ms` }}
        >
          <div
            className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
            style={{ backgroundImage: `url(${item.img})` }}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-black/10 via-black/50 to-black/95" />
          <div className="absolute inset-x-0 bottom-0 p-5">
            <h3 className="mb-2 text-xl font-bold text-[#63C6AD]">{item.title}</h3>
            <p className="text-sm leading-relaxed text-white/90">{item.desc}</p>
          </div>
        </article>
      ))}
    </div>
  );
}
