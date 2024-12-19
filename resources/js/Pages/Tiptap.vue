<template>
  <!-- <editor-content :editor="editor" /> -->
    <div class="w-full max-w-4xl mx-auto">
    <!-- Editor Wrapper -->
    <div class="border border-zinc-400 rounded-md overflow-hidden">
      <!-- Toolbar -->
      <div class="bg-zinc-50 border-b border-zinc-400 p-2 flex flex-wrap gap-2">
        <button
          @click="editor?.chain().focus().toggleBold().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('bold') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          <strong>B</strong>
        </button>

        <button
          @click="editor?.chain().focus().toggleItalic().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('italic') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          <em>I</em>
        </button>

        <button
          @click="editor?.chain().focus().toggleStrike().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('strike') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          <s>S</s>
        </button>

        <div class="h-6 w-px bg-gray-300"></div>

        <button
          @click="editor?.chain().focus().setParagraph().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('paragraph') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          P
        </button>

        <button
          @click="editor?.chain().focus().toggleHeading({ level: 1 }).run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('heading', { level: 1 }) }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          H1
        </button>

        <button
          @click="editor?.chain().focus().toggleHeading({ level: 2 }).run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('heading', { level: 2 }) }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          H2
        </button>

        <div class="h-6 w-px bg-gray-300"></div>

        <button
          @click="editor?.chain().focus().toggleBulletList().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('bulletList') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          • List
        </button>

        <button
          @click="editor?.chain().focus().toggleOrderedList().run()"
          :class="{ 'bg-white ring-2 ring-blue-500 text-blue-500': editor?.isActive('orderedList') }"
          class="px-3 py-1.5 border border-gray-300 rounded text-sm font-medium hover:bg-gray-100 transition-colors"
        >
          1. List
        </button>
      </div>

      <!-- Editor Content -->
      <editor-content 
        :editor="editor" 
        class="prose w-full h-32 max-h-32 max-w-none px-2 focus:outline-none"
      />
    </div>
  </div>
</template>

<script setup>
  import { useEditor, EditorContent } from '@tiptap/vue-3'
  import StarterKit from '@tiptap/starter-kit'

  const editor = useEditor({
    content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
  }
  })

  const getContent = () => {
  if (editor.value) {
    // const html = editor.value.getHTML()  // Get HTML content
    // const json = editor.value.getJSON()  // Get JSON content
    const text = editor.value.getText()  // Get plain text
    return text
  }
}
defineExpose({
    getContent
})
</script>

<style>
/* Reset outline and line height */
.ProseMirror {
  @apply leading-normal outline-none;
}

/* Override default prose styles */
.prose p {
  @apply my-1 leading-normal;
}

.prose > * + * {
  @apply mt-2;
}

.prose ul,
.prose ol {
  @apply pl-6 my-1;
}

.prose h1 {
  @apply text-3xl font-bold my-2 leading-normal;
}

.prose h2 {
  @apply text-2xl font-bold my-2 leading-normal;
}

.prose code {
  @apply bg-gray-100 px-1.5 py-0.5 rounded text-sm;
}

.prose blockquote {
  @apply border-l-4 border-gray-300 pl-4 italic text-gray-600 my-2;
}

/* Additional style to ensure outline is removed in all states */
.ProseMirror-focused {
  @apply outline-none ring-0;
}
</style>
