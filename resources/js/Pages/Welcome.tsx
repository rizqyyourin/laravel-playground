import { PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function Welcome({
    auth,
    laravelVersion,
    phpVersion,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    return (
        <>
            <Head>
                <title>Laravel Playground - Interactive Laravel Guides & Tutorials</title>
                <meta
                    name="description"
                    content="Master Laravel with our interactive playground. Run PHP code, learn Eloquent, Sanctum, and more with live examples and comprehensive guides."
                />
                <meta
                    name="keywords"
                    content="laravel guide, laravel playground, interactive php, learn laravel, laravel tutorial, eloquent, sanctum, pest php"
                />
            </Head>

            <div className="min-h-screen bg-white text-zinc-950 dark:bg-zinc-950 dark:text-white font-sans selection:bg-[#FF2D20] selection:text-white">
                {/* Navbar */}
                <header className="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur-sm dark:border-zinc-800 dark:bg-zinc-950/80">
                    <div className="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                        <div className="flex items-center gap-2">
                            <svg
                                className="h-8 w-8 text-[#FF2D20]"
                                viewBox="0 0 62 65"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C24.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z"
                                    fill="currentColor"
                                />
                            </svg>
                            <span className="text-xl font-bold tracking-tighter text-zinc-900 dark:text-white">
                                Laravel Playground
                            </span>
                        </div>
                        <nav className="flex items-center gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-flex items-center justify-center rounded-md bg-[#FF2D20] px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-[#FF2D20]/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] disabled:pointer-events-none disabled:opacity-50"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <Link
                                    href={route('login')}
                                    className="inline-flex items-center justify-center rounded-md bg-[#FF2D20] px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-[#FF2D20]/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] disabled:pointer-events-none disabled:opacity-50"
                                >
                                    Login
                                </Link>
                            )}
                        </nav>
                    </div>
                </header>

                <main>
                    {/* Hero Section */}
                    <section className="relative overflow-hidden pt-16 md:pt-24 lg:pt-32">
                        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div className="mx-auto max-w-3xl text-center">
                                <h1 className="text-4xl font-bold tracking-tight text-zinc-900 sm:text-6xl dark:text-white">
                                    Master Laravel with{' '}
                                    <span className="text-[#FF2D20]">Interactive Playground</span>
                                </h1>
                                <p className="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                                    Experience the power of Laravel code execution directly in your browser.
                                    Learn best practices, experiment with packages, and build your skills with
                                    comprehensive interactive guides.
                                </p>
                                <div className="mt-10 flex items-center justify-center gap-x-6">
                                    <Link
                                        href={route('packages.index')}
                                        className="rounded-md bg-[#FF2D20] px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#FF2D20]/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FF2D20]"
                                    >
                                        Start Learning
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="text-sm font-semibold leading-6 text-zinc-900 dark:text-white"
                                    >
                                        Create Account <span aria-hidden="true">→</span>
                                    </Link>
                                </div>
                            </div>

                            {/* Code Preview Mockup */}
                            <div className="mt-16 flow-root sm:mt-24">
                                <div className="mx-auto max-w-5xl rounded-xl bg-zinc-900/5 p-2 ring-1 ring-inset ring-zinc-900/10 lg:rounded-2xl lg:p-4 dark:bg-white/5 dark:ring-white/10">
                                    <div className="rounded-lg bg-zinc-900 shadow-2xl ring-1 ring-zinc-900/10">
                                        <div className="flex items-center gap-2 border-b border-zinc-700 px-4 py-3">
                                            <div className="h-3 w-3 rounded-full bg-red-500"></div>
                                            <div className="h-3 w-3 rounded-full bg-yellow-500"></div>
                                            <div className="h-3 w-3 rounded-full bg-green-500"></div>
                                            <span className="ml-2 text-xs font-mono text-zinc-400">example.php</span>
                                        </div>
                                        <div className="overflow-x-auto p-4">
                                            <pre className="text-sm font-mono leading-relaxed text-zinc-300">
                                                <code>
                                                    <span className="text-[#c678dd]">use</span> <span className="text-[#e5c07b]">App\Models\User</span>;{'\n'}
                                                    <span className="text-[#c678dd]">use</span> <span className="text-[#e5c07b]">Laravel\Sanctum\HasApiTokens</span>;{'\n'}
                                                    {'\n'}
                                                    <span className="text-[#c678dd]">class</span> <span className="text-[#e5c07b]">User</span> <span className="text-[#c678dd]">extends</span> <span className="text-[#e5c07b]">Authenticatable</span>{'\n'}
                                                    {'{'}{'\n'}
                                                    <span className="text-[#c678dd]">use</span> <span className="text-[#e5c07b]">HasApiTokens</span>;{'\n'}
                                                    {'\n'}
                                                    <span className="text-[#61afef]">// Create a new token for the user</span>{'\n'}
                                                    <span className="text-[#c678dd]">$token</span> = <span className="text-[#c678dd]">$user</span>{'->'}<span className="text-[#61afef]">createToken</span>(<span className="text-[#98c379]">'api-token'</span>);{'\n'}
                                                    {'\n'}
                                                    <span className="text-[#c678dd]">return</span> <span className="text-[#c678dd]">$token</span>{'->'}<span className="text-[#e06c75]">plainTextToken</span>;{'\n'}
                                                    {'}'}
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {/* Features Grid */}
                    <section className="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
                        <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                            <div className="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-all hover:border-[#FF2D20]/50 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                                <div className="mb-4 inline-flex items-center justify-center rounded-lg bg-[#FF2D20]/10 p-3 text-[#FF2D20]">
                                    <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </div>
                                <h3 className="mb-3 text-xl font-semibold text-zinc-900 dark:text-white">Interactive Editor</h3>
                                <p className="text-zinc-600 dark:text-zinc-400">
                                    Write and execute PHP code directly in your browser with Monaco Editor support, highlighting, and autocompletion.
                                </p>
                            </div>

                            <div className="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-all hover:border-[#FF2D20]/50 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                                <div className="mb-4 inline-flex items-center justify-center rounded-lg bg-[#FF2D20]/10 p-3 text-[#FF2D20]">
                                    <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 className="mb-3 text-xl font-semibold text-zinc-900 dark:text-white">Comprehensive Guides</h3>
                                <p className="text-zinc-600 dark:text-zinc-400">
                                    Deep dive into Sanctum, Eloquent, and more with step-by-step interactive tutorials tailored for all levels.
                                </p>
                            </div>

                            <div className="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-all hover:border-[#FF2D20]/50 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                                <div className="mb-4 inline-flex items-center justify-center rounded-lg bg-[#FF2D20]/10 p-3 text-[#FF2D20]">
                                    <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                                <h3 className="mb-3 text-xl font-semibold text-zinc-900 dark:text-white">Real-world Scenarios</h3>
                                <p className="text-zinc-600 dark:text-zinc-400">
                                    Practice with realistic inputs and expected outputs. Master N+1 queries, detailed authentication flows, and testing.
                                </p>
                            </div>
                        </div>
                    </section>

                    {/* CTA Section */}
                    <section className="bg-zinc-50 py-24 dark:bg-zinc-900/50">
                        <div className="container mx-auto px-4 text-center">
                            <h2 className="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                                Ready to level up your Laravel skills?
                            </h2>
                            <p className="mx-auto mt-6 max-w-xl text-lg text-zinc-600 dark:text-zinc-400">
                                Join our community of developers mastering Laravel through interactive learning.
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-6">
                                <Link
                                    href={route('register')}
                                    className="rounded-md bg-[#FF2D20] px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#FF2D20]/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FF2D20]"
                                >
                                    Get Started Free
                                </Link>
                            </div>
                        </div>
                    </section>
                </main>

                <footer className="border-t border-zinc-200 bg-white py-12 dark:border-zinc-800 dark:bg-zinc-950">
                    <div className="container mx-auto px-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                        <p>&copy; {new Date().getFullYear()} Laravel Playground. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </>
    );
}
