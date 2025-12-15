import Editor from '@monaco-editor/react';
import { useState } from 'react';

interface CodeEditorProps {
    code: string;
    language?: 'php' | 'javascript' | 'typescript' | 'html' | 'json' | 'blade';
    readOnly?: boolean;
    height?: string;
    onChange?: (value: string | undefined) => void;
    theme?: 'light' | 'dark';
}

export default function CodeEditor({
    code,
    language = 'php',
    readOnly = false,
    height = '400px',
    onChange,
    theme,
}: CodeEditorProps) {
    const [copied, setCopied] = useState(false);

    const handleCopy = async () => {
        try {
            await navigator.clipboard.writeText(code);
            setCopied(true);
            setTimeout(() => setCopied(false), 2000);
        } catch (err) {
            console.error('Failed to copy:', err);
        }
    };

    // Map blade to html for Monaco
    const editorLanguage = language === 'blade' ? 'html' : language;

    return (
        <div className="relative overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
            {/* Header with language and copy button */}
            <div className="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-4 py-2 dark:border-gray-700 dark:bg-gray-800">
                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                    {language.toUpperCase()}
                </span>
                <button
                    onClick={handleCopy}
                    className="flex items-center gap-2 rounded-md bg-white px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                >
                    {copied ? (
                        <>
                            <svg
                                className="h-4 w-4 text-green-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            Copied!
                        </>
                    ) : (
                        <>
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
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                />
                            </svg>
                            Copy
                        </>
                    )}
                </button>
            </div>

            {/* Monaco Editor */}
            <Editor
                height={height}
                language={editorLanguage}
                value={code}
                onChange={onChange}
                theme={theme === 'dark' ? 'vs-dark' : 'vs-light'}
                options={{
                    readOnly,
                    minimap: { enabled: false },
                    fontSize: 14,
                    lineNumbers: 'on',
                    scrollBeyondLastLine: false,
                    automaticLayout: true,
                    tabSize: 4,
                    wordWrap: 'on',
                    padding: { top: 16, bottom: 16 },
                    scrollbar: {
                        vertical: 'auto',
                        horizontal: 'auto',
                    },
                }}
                loading={
                    <div className="flex h-full items-center justify-center bg-white dark:bg-gray-900">
                        <div className="text-gray-500 dark:text-gray-400">Loading editor...</div>
                    </div>
                }
            />
        </div>
    );
}
