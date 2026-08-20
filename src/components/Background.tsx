export function Background() {
  return (
    <>
      {/* eslint-disable-next-line @next/next/no-img-element */}
      <img
        src="/degradado.jpeg"
        alt=""
        className="fixed top-0 left-0 -z-20 h-full w-full object-cover"
      />
      <div className="fixed inset-0 -z-10 bg-black/40" />
    </>
  );
}
