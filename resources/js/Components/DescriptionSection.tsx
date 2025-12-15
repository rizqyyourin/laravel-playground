import ReactMarkdown from 'react-markdown';
import CodeEditor from './CodeEditor';

interface DescriptionSectionProps {
    content: string;
}

export default function DescriptionSection({ content }: DescriptionSectionProps) {
    // Parse the content to identify sections
    const sections = content.split(/\*\*(Scenario|Input|Expected Output|Expected Behavior|Use Case|Setup|Step \d+)\*\*:/);

    const getSectionStyle = (sectionType: string) => {
        const type = sectionType.toLowerCase();

        if (type.includes('scenario') || type.includes('use case')) {
            return {
                bg: 'bg-blue-50 dark:bg-blue-900/20',
                border: 'border-l-4 border-blue-500',
                icon: '📖',
                title: 'text-blue-900 dark:text-blue-300',
            };
        }

        if (type.includes('input') || type.includes('setup')) {
            return {
                bg: 'bg-green-50 dark:bg-green-900/20',
                border: 'border-l-4 border-green-500',
                icon: '📥',
                title: 'text-green-900 dark:text-green-300',
            };
        }

        if (type.includes('expected output') || type.includes('expected behavior')) {
            return {
                bg: 'bg-purple-50 dark:bg-purple-900/20',
                border: 'border-l-4 border-purple-500',
                icon: '✅',
                title: 'text-purple-900 dark:text-purple-300',
            };
        }

        if (type.includes('step')) {
            return {
                bg: 'bg-amber-50 dark:bg-amber-900/20',
                border: 'border-l-4 border-amber-500',
                icon: '🔢',
                title: 'text-amber-900 dark:text-amber-300',
            };
        }

        return {
            bg: 'bg-gray-50 dark:bg-gray-900/20',
            border: 'border-l-4 border-gray-500',
            icon: '📝',
            title: 'text-gray-900 dark:text-gray-300',
        };
    };

    // Custom component to render code blocks as mini editors
    const components = {
        code: ({ node, inline, className, children, ...props }: any) => {
            const match = /language-(\w+)/.exec(className || '');
            let language = match ? match[1] : '';
            const codeString = String(children).replace(/\n$/, '');

            // Auto-detect language if not specified
            if (!language) {
                if (codeString.includes('<?php') || codeString.includes('$') || codeString.includes('->') || codeString.includes('::')) {
                    language = 'php';
                } else if (codeString.includes('function') || codeString.includes('const ') || codeString.includes('let ') || codeString.includes('=>')) {
                    language = 'javascript';
                } else if (codeString.trim().startsWith('{') || codeString.trim().startsWith('[')) {
                    language = 'json';
                } else {
                    language = 'php'; // default to PHP for Laravel tutorials
                }
            }

            // Inline code (backticks)
            if (inline) {
                return (
                    <code
                        className="rounded bg-white/70 px-1.5 py-0.5 text-sm font-mono text-gray-800 dark:bg-gray-800/70 dark:text-gray-200"
                        {...props}
                    >
                        {children}
                    </code>
                );
            }

            // Calculate height based on number of lines (min 60px, max 400px)
            const lineCount = codeString.split('\n').length;
            const lineHeight = 20; // approximate line height in pixels
            const padding = 40; // padding for header
            const calculatedHeight = Math.min(Math.max(lineCount * lineHeight + padding, 80), 400);

            // Code blocks (triple backticks) - render as mini editor
            return (
                <div className="my-3">
                    <CodeEditor
                        code={codeString}
                        language={language as any}
                        readOnly={true}
                        height={`${calculatedHeight}px`}
                        theme="dark"
                    />
                </div>
            );
        },
    };

    const renderSection = (sectionType: string, sectionContent: string, index: number) => {
        const style = getSectionStyle(sectionType);

        return (
            <div
                key={index}
                className={`mb-4 rounded-r-lg ${style.bg} ${style.border} p-4`}
            >
                <div className="mb-2 flex items-center gap-2">
                    <span className="text-lg">{style.icon}</span>
                    <h4 className={`font-bold ${style.title}`}>{sectionType}</h4>
                </div>
                <div className="prose prose-sm max-w-none dark:prose-invert prose-p:my-2 prose-p:text-gray-700 dark:prose-p:text-gray-300">
                    <ReactMarkdown components={components}>{sectionContent.trim()}</ReactMarkdown>
                </div>
            </div>
        );
    };

    // If no sections found, render as plain markdown
    if (sections.length <= 1) {
        return (
            <div className="prose prose-gray mb-6 max-w-none dark:prose-invert">
                <ReactMarkdown components={components}>{content}</ReactMarkdown>
            </div>
        );
    }

    // Render sections with styling
    const renderedSections = [];
    for (let i = 1; i < sections.length; i += 2) {
        const sectionType = sections[i];
        const sectionContent = sections[i + 1] || '';
        renderedSections.push(renderSection(sectionType, sectionContent, i));
    }

    return <div className="mb-6">{renderedSections}</div>;
}
