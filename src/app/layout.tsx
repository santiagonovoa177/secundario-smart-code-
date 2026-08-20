import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import { Background } from "@/components/Background";
import { Footer } from "@/components/Footer";
import { Header } from "@/components/Header";
import { Loader } from "@/components/Loader";
import { PageTransition } from "@/components/PageTransition";
import { site } from "@/lib/content";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: site.shortName,
  description: site.description,
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html
      lang="en"
      className={`${geistSans.variable} ${geistMono.variable} h-full antialiased`}
    >
      <body className="flex min-h-full flex-col overflow-x-hidden">
        <Loader />
        <Background />
        <Header />
        <PageTransition>
          {children}
          <Footer />
        </PageTransition>
      </body>
    </html>
  );
}
