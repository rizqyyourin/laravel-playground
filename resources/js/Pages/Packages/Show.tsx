import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';

interface Category {
    id: number;
    name: string;
    slug: string;
    icon: string;
}

interface Tutorial {
    id: number;
    title: string;
    slug: string;
    order: number;
    estimated_time: number | null;
}

interface Package {
    id: number;
    name: string;
    slug: string;
    description: string;
    composer_package: string | null;
    documentation_url: string | null;
    github_url: string | null;
    difficulty_level: 'beginner' | 'intermediate' | 'advanced';
    is_official: boolean;
    popularity_score: number;
    category: Category;
    tutorials: Tutorial[];
    tutorials_count: number;
}

interface PackageShowProps extends PageProps {
    package: Package;
}

export default function Show({ package: pkg }: PackageShowProps) {
    const getDifficultyColor = (level: string) => {
        switch (level) {
            case 'beginner':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
            case 'intermediate':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
            case 'advanced':
                return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300';
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <Link
                            href="/packages"
                            className="mb-2 inline-flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100"
                        >
                            ← Back to Packages
                        </Link>
                        <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            {pkg.name}
                        </h2>
                    </div>
                </div>
            }
        >
            <Head title={pkg.name} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="grid gap-8 lg:grid-cols-3">
                        {/* Main Content */}
                        <div className="lg:col-span-2">
                            {/* Package Info Card */}
                            <div className="mb-8 overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                <div className="p-8">
                                    <div className="mb-6 flex items-start justify-between">
                                        <div className="flex-1">
                                            <h1 className="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                                                {pkg.name}
                                            </h1>
                                            <p className="text-gray-600 dark:text-gray-400">
                                                {pkg.category.icon} {pkg.category.name}
                                            </p>
                                        </div>
                                        {pkg.is_official && (
                                            <span className="rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                Official Package
                                            </span>
                                        )}
                                    </div>

                                    <p className="mb-6 text-lg text-gray-700 dark:text-gray-300">
                                        {pkg.description}
                                    </p>

                                    <div className="flex flex-wrap gap-4">
                                        <span
                                            className={`rounded-full px-4 py-2 text-sm font-medium capitalize ${getDifficultyColor(
                                                pkg.difficulty_level,
                                            )}`}
                                        >
                                            {pkg.difficulty_level}
                                        </span>
                                        <span className="rounded-full bg-purple-100 px-4 py-2 text-sm font-medium text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                            ⭐ Popularity: {pkg.popularity_score}
                                        </span>
                                        <span className="rounded-full bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                            📚 {pkg.tutorials_count} Tutorials
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {/* Tutorials List */}
                            <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                <div className="border-b border-gray-200 p-6 dark:border-gray-700">
                                    <h2 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                        Tutorials
                                    </h2>
                                </div>
                                <div className="p-6">
                                    {pkg.tutorials.length > 0 ? (
                                        <div className="space-y-4">
                                            {pkg.tutorials.map((tutorial, index) => (
                                                <Link
                                                    key={tutorial.id}
                                                    href={`/tutorials/${tutorial.slug}`}
                                                    className="block rounded-lg border border-gray-200 p-4 transition-all hover:border-indigo-500 hover:shadow-md dark:border-gray-700 dark:hover:border-indigo-500"
                                                >
                                                    <div className="flex items-start justify-between">
                                                        <div className="flex-1">
                                                            <div className="mb-2 flex items-center gap-3">
                                                                <span className="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300">
                                                                    {index + 1}
                                                                </span>
                                                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                                    {tutorial.title}
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        {tutorial.estimated_time && (
                                                            <span className="ml-4 text-sm text-gray-500 dark:text-gray-400">
                                                                ⏱️ {tutorial.estimated_time} min
                                                            </span>
                                                        )}
                                                    </div>
                                                </Link>
                                            ))}
                                        </div>
                                    ) : (
                                        <div className="rounded-lg bg-gray-50 p-8 text-center dark:bg-gray-900">
                                            <p className="text-gray-600 dark:text-gray-400">
                                                No tutorials available yet for this package.
                                            </p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>

                        {/* Sidebar */}
                        <div className="lg:col-span-1">
                            <div className="sticky top-8 space-y-6">
                                {/* Quick Links */}
                                <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                    <div className="border-b border-gray-200 p-4 dark:border-gray-700">
                                        <h3 className="font-semibold text-gray-900 dark:text-gray-100">
                                            Quick Links
                                        </h3>
                                    </div>
                                    <div className="p-4">
                                        <div className="space-y-3">
                                            {pkg.composer_package && (
                                                <div>
                                                    <p className="mb-1 text-xs font-medium text-gray-500 dark:text-gray-400">
                                                        Composer Package
                                                    </p>
                                                    <code className="block rounded bg-gray-100 px-3 py-2 text-sm text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                                        {pkg.composer_package}
                                                    </code>
                                                </div>
                                            )}
                                            {pkg.documentation_url && (
                                                <a
                                                    href={pkg.documentation_url}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50"
                                                >
                                                    📖 Documentation
                                                    <svg
                                                        className="h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            strokeWidth={2}
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                                        />
                                                    </svg>
                                                </a>
                                            )}
                                            {pkg.github_url && (
                                                <a
                                                    href={pkg.github_url}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="flex items-center gap-2 rounded-lg bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800"
                                                >
                                                    🔗 GitHub Repository
                                                    <svg
                                                        className="h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            strokeWidth={2}
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                                        />
                                                    </svg>
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                </div>

                                {/* Related Packages */}
                                <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                    <div className="border-b border-gray-200 p-4 dark:border-gray-700">
                                        <h3 className="font-semibold text-gray-900 dark:text-gray-100">
                                            More in {pkg.category.name}
                                        </h3>
                                    </div>
                                    <div className="p-4">
                                        <Link
                                            href={`/packages?category=${pkg.category.slug}`}
                                            className="block rounded-lg bg-indigo-50 px-4 py-3 text-center text-sm font-medium text-indigo-700 transition-colors hover:bg-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50"
                                        >
                                            View All {pkg.category.icon}
                                        </Link>
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
