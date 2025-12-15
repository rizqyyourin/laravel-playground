import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import CodeEditor from '@/Components/CodeEditor';
import DescriptionSection from '@/Components/DescriptionSection';
import { PageProps } from '@/types';
import { useState } from 'react';

interface Category {
    id: number;
    name: string;
    slug: string;
    icon: string;
}

interface Package {
    id: number;
    name: string;
    slug: string;
    category: Category;
}

interface CodeExample {
    id: number;
    title: string;
    description: string | null;
    code: string;
    language: 'php' | 'javascript' | 'typescript' | 'html' | 'json' | 'blade';
    order: number;
}

interface Tutorial {
    id: number;
    title: string;
    slug: string;
    content: string;
    estimated_time: number | null;
    package: Package;
    code_examples: CodeExample[];
}

interface TutorialShowProps extends PageProps {
    tutorial: Tutorial;
}

export default function Show({ tutorial }: TutorialShowProps) {
    const [activeExample, setActiveExample] = useState(0);
    const [theme, setTheme] = useState<'light' | 'dark'>('dark');

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <Link
                            href={`/packages/${tutorial.package.slug}`}
                            className="mb-2 inline-flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100"
                        >
                            ← Back to {tutorial.package.name}
                        </Link>
                        <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            {tutorial.title}
                        </h2>
                    </div>
                    {tutorial.estimated_time && (
                        <span className="text-sm text-gray-600 dark:text-gray-400">
                            ⏱️ {tutorial.estimated_time} minutes
                        </span>
                    )}
                </div>
            }
        >
            <Head title={tutorial.title} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="grid gap-8 lg:grid-cols-3">
                        {/* Main Content */}
                        <div className="lg:col-span-2">
                            {/* Tutorial Content */}
                            <div className="mb-8 overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                <div className="border-b border-gray-200 p-6 dark:border-gray-700">
                                    <div className="mb-4 flex items-center gap-3">
                                        <span className="text-2xl">{tutorial.package.category.icon}</span>
                                        <div>
                                            <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                                {tutorial.title}
                                            </h1>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                {tutorial.package.name}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div className="p-6">
                                    <div
                                        className="prose prose-gray max-w-none dark:prose-invert"
                                        dangerouslySetInnerHTML={{
                                            __html: tutorial.content.replace(/\n/g, '<br />'),
                                        }}
                                    />
                                </div>
                            </div>

                            {/* Code Examples */}
                            {tutorial.code_examples.length > 0 && (
                                <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                    <div className="border-b border-gray-200 p-6 dark:border-gray-700">
                                        <div className="flex items-center justify-between">
                                            <h2 className="text-xl font-bold text-gray-900 dark:text-gray-100">
                                                Code Examples
                                            </h2>
                                            <button
                                                onClick={() => setTheme(theme === 'dark' ? 'light' : 'dark')}
                                                className="rounded-md bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                                            >
                                                {theme === 'dark' ? '☀️ Light' : '🌙 Dark'}
                                            </button>
                                        </div>
                                    </div>

                                    {/* Tabs */}
                                    <div className="border-b border-gray-200 dark:border-gray-700">
                                        <div className="flex overflow-x-auto">
                                            {tutorial.code_examples.map((example, index) => (
                                                <button
                                                    key={example.id}
                                                    onClick={() => setActiveExample(index)}
                                                    className={`whitespace-nowrap border-b-2 px-6 py-3 text-sm font-medium transition-colors ${activeExample === index
                                                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400'
                                                        : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'
                                                        }`}
                                                >
                                                    {example.title}
                                                </button>
                                            ))}
                                        </div>
                                    </div>

                                    {/* Active Example */}
                                    <div className="p-6">
                                        {tutorial.code_examples[activeExample] && (
                                            <div>
                                                {tutorial.code_examples[activeExample].description && (
                                                    <DescriptionSection
                                                        content={tutorial.code_examples[activeExample].description}
                                                    />
                                                )}
                                                <CodeEditor
                                                    code={tutorial.code_examples[activeExample].code}
                                                    language={tutorial.code_examples[activeExample].language}
                                                    readOnly={false}
                                                    height="500px"
                                                    theme={theme}
                                                />
                                            </div>
                                        )}
                                    </div>
                                </div>
                            )}
                        </div>

                        {/* Sidebar */}
                        <div className="lg:col-span-1">
                            <div className="sticky top-8 space-y-6">
                                {/* Package Info */}
                                <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                    <div className="border-b border-gray-200 p-4 dark:border-gray-700">
                                        <h3 className="font-semibold text-gray-900 dark:text-gray-100">
                                            About This Package
                                        </h3>
                                    </div>
                                    <div className="p-4">
                                        <Link
                                            href={`/packages/${tutorial.package.slug}`}
                                            className="group block"
                                        >
                                            <div className="mb-2 flex items-center gap-2">
                                                <span className="text-xl">{tutorial.package.category.icon}</span>
                                                <h4 className="font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                                                    {tutorial.package.name}
                                                </h4>
                                            </div>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                {tutorial.package.category.name}
                                            </p>
                                        </Link>
                                    </div>
                                </div>

                                {/* Tips */}
                                <div className="overflow-hidden rounded-lg bg-blue-50 shadow-sm dark:bg-blue-900/20">
                                    <div className="p-4">
                                        <div className="mb-2 flex items-center gap-2">
                                            <span className="text-xl">💡</span>
                                            <h3 className="font-semibold text-blue-900 dark:text-blue-300">
                                                Pro Tip
                                            </h3>
                                        </div>
                                        <p className="text-sm text-blue-800 dark:text-blue-200">
                                            You can edit the code examples directly in the editor. Try modifying
                                            the code to see how it works!
                                        </p>
                                    </div>
                                </div>

                                {/* Quick Actions */}
                                <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                    <div className="border-b border-gray-200 p-4 dark:border-gray-700">
                                        <h3 className="font-semibold text-gray-900 dark:text-gray-100">
                                            Quick Actions
                                        </h3>
                                    </div>
                                    <div className="p-4">
                                        <div className="space-y-2">
                                            <Link
                                                href={`/packages/${tutorial.package.slug}`}
                                                className="block rounded-lg bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800"
                                            >
                                                📚 View All Tutorials
                                            </Link>
                                            <Link
                                                href="/packages"
                                                className="block rounded-lg bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800"
                                            >
                                                🔍 Browse Packages
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
