import { Head, Link, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import { useState } from 'react';

interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    icon: string;
    packages_count: number;
}

interface Package {
    id: number;
    name: string;
    slug: string;
    description: string;
    difficulty_level: 'beginner' | 'intermediate' | 'advanced';
    is_official: boolean;
    popularity_score: number;
    category: Category;
    tutorials_count: number;
}

interface PackagesProps extends PageProps {
    packages: {
        data: Package[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    categories: Category[];
    filters: {
        search?: string;
        category?: string;
        difficulty?: string;
        official?: boolean;
    };
}

export default function Index({ packages, categories, filters }: PackagesProps) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get('/packages', { search }, { preserveState: true });
    };

    const filterByCategory = (categorySlug: string | null) => {
        router.get('/packages', { ...filters, category: categorySlug || undefined }, { preserveState: true });
    };

    const filterByDifficulty = (difficulty: string | null) => {
        router.get('/packages', { ...filters, difficulty: difficulty || undefined }, { preserveState: true });
    };

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
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Laravel Packages
                    </h2>
                    <span className="text-sm text-gray-600 dark:text-gray-400">
                        {packages.total} packages available
                    </span>
                </div>
            }
        >
            <Head title="Laravel Packages" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {/* Search Bar */}
                    <div className="mb-8">
                        <form onSubmit={handleSearch} className="flex gap-4">
                            <input
                                type="text"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                placeholder="Search packages..."
                                className="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            />
                            <button
                                type="submit"
                                className="rounded-lg bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <div className="grid gap-8 lg:grid-cols-4">
                        {/* Sidebar Filters */}
                        <div className="lg:col-span-1">
                            <div className="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
                                <div className="p-6">
                                    <h3 className="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        Filters
                                    </h3>

                                    {/* Categories */}
                                    <div className="mb-6">
                                        <h4 className="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Categories
                                        </h4>
                                        <div className="space-y-2">
                                            <button
                                                onClick={() => filterByCategory(null)}
                                                className={`w-full rounded-md px-3 py-2 text-left text-sm transition-colors ${!filters.category
                                                    ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300'
                                                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                    }`}
                                            >
                                                All Categories
                                            </button>
                                            {categories.map((category) => (
                                                <button
                                                    key={category.id}
                                                    onClick={() => filterByCategory(category.slug)}
                                                    className={`w-full rounded-md px-3 py-2 text-left text-sm transition-colors ${filters.category === category.slug
                                                        ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300'
                                                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                        }`}
                                                >
                                                    <span className="mr-2">{category.icon}</span>
                                                    {category.name}
                                                    <span className="ml-2 text-xs text-gray-500">
                                                        ({category.packages_count})
                                                    </span>
                                                </button>
                                            ))}
                                        </div>
                                    </div>

                                    {/* Difficulty Level */}
                                    <div>
                                        <h4 className="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Difficulty Level
                                        </h4>
                                        <div className="space-y-2">
                                            <button
                                                onClick={() => filterByDifficulty(null)}
                                                className={`w-full rounded-md px-3 py-2 text-left text-sm transition-colors ${!filters.difficulty
                                                    ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300'
                                                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                    }`}
                                            >
                                                All Levels
                                            </button>
                                            {['beginner', 'intermediate', 'advanced'].map((level) => (
                                                <button
                                                    key={level}
                                                    onClick={() => filterByDifficulty(level)}
                                                    className={`w-full rounded-md px-3 py-2 text-left text-sm capitalize transition-colors ${filters.difficulty === level
                                                        ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300'
                                                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                        }`}
                                                >
                                                    {level}
                                                </button>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Packages Grid */}
                        <div className="lg:col-span-3">
                            <div className="grid gap-6 md:grid-cols-2">
                                {packages.data.map((pkg) => (
                                    <Link
                                        key={pkg.id}
                                        href={`/packages/${pkg.slug}`}
                                        className="group overflow-hidden rounded-lg bg-white shadow-sm transition-all hover:shadow-lg dark:bg-gray-800"
                                    >
                                        <div className="p-6">
                                            <div className="mb-3 flex items-start justify-between">
                                                <div className="flex-1">
                                                    <h3 className="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                                                        {pkg.name}
                                                    </h3>
                                                    <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                        {pkg.category.icon} {pkg.category.name}
                                                    </p>
                                                </div>
                                                {pkg.is_official && (
                                                    <span className="rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                        Official
                                                    </span>
                                                )}
                                            </div>

                                            <p className="mb-4 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">
                                                {pkg.description}
                                            </p>

                                            <div className="flex items-center justify-between">
                                                <span
                                                    className={`rounded-full px-3 py-1 text-xs font-medium capitalize ${getDifficultyColor(
                                                        pkg.difficulty_level,
                                                    )}`}
                                                >
                                                    {pkg.difficulty_level}
                                                </span>
                                                <div className="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                                    <span>⭐ {pkg.popularity_score}</span>
                                                    <span>📚 {pkg.tutorials_count} tutorials</span>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                ))}
                            </div>

                            {/* Pagination */}
                            {packages.last_page > 1 && (
                                <div className="mt-8 flex justify-center gap-2">
                                    {Array.from({ length: packages.last_page }, (_, i) => i + 1).map((page) => (
                                        <Link
                                            key={page}
                                            href={`/packages?page=${page}`}
                                            className={`rounded-md px-4 py-2 text-sm ${page === packages.current_page
                                                ? 'bg-indigo-600 text-white'
                                                : 'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700'
                                                }`}
                                        >
                                            {page}
                                        </Link>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
