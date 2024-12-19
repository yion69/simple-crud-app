<template>

	<div class="main-container">
		<div class="editor-container editor-container_classic-editor" ref="editorContainerElement">
			<div class="editor-container__editor">
				<div ref="editorElement">
						<ckeditor
							:editor="editor"
							:config="config"
							@ready="onEditorReady"
							@input="onEditorChange"
							ref="editorRef"
							
						/>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed, ref, onMounted, watchEffect } from 'vue';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';

import {
	ClassicEditor,
	Autoformat,
	AutoImage,
	Autosave,
	BlockQuote,
	Bold,
	CKBox,
	CKBoxImageEdit,
	CloudServices,
	Essentials,
	Heading,
	ImageBlock,
	ImageCaption,
	ImageInline,
	ImageInsert,
	ImageInsertViaUrl,
	ImageResize,
	ImageStyle,
	ImageTextAlternative,
	ImageToolbar,
	ImageUpload,
	Indent,
	IndentBlock,
	Italic,
	Link,
	LinkImage,
	List,
	ListProperties,
	MediaEmbed,
	Paragraph,
	PasteFromOffice,
	PictureEditing,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableProperties,
	TableToolbar,
	TextTransformation,
	TodoList,
	Underline
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

const editorRef = ref(null);
const emit = defineEmits(['update:modelValue']);

// Expose editor instance
defineExpose({
  editorRef,
  getData: () => editorRef.value?.instance?.getData()
});

const onEditorReady = (editor) => {
  // Store editor instance for direct access
  editorRef.value.instance = editor;
};

const onEditorChange = () => {
  const content = editorRef.value?.instance?.getData();
  emit('update:modelValue', content);
};


const LICENSE_KEY =
	'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NjYxMDIzOTksImp0aSI6IjA1NjA3NjA4LTU2YzYtNDZkMS04YzU3LWVlMDQ4Y2Q4NjMwYyIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIiwiQk9YIl0sInZjIjoiNzUwZjA2ZDYifQ.0bHWtHPBByrlMvTsJAt87S0imR42C9idgQIT2bjU8jXH8-M6XxDp4G5GRNIPgXFrbNL8Dp8Ebavl5C-xEsEtmQ';
	// 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3MzU3NzU5OTksImp0aSI6IjQ1ZGVkZDhmLWFhNzUtNGI0OC1hMDZkLTdhYjljOWYwNDk1MSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImRjZDI4YmM5In0._oYR0UJ0gNkgWEvxHCjAUWoVqWlGOPB82J46WLNq8hCoP034dycWjzzGfZu27NI1Tc_jVXgXvKpgIs8kz9TUfw';

const CLOUD_SERVICES_TOKEN_URL =
	'https://h22obbrp2rvn.cke-cs.com/token/dev/08afad5f52d796742ef6932f025b11158e36a0f163fb9369b7d12b7c7486?limit=10';

const isLayoutReady = ref(false);

const editor = ClassicEditor;

const config = computed(() => {
	if (!isLayoutReady.value) {
		return null;
	}

	return {
		ui: {
			height: "100px"
		},
		toolbar: {
			items: [
				'italic',
				'underline',
				'|',
				'link',
				'insertImage',
				'ckbox',
				'mediaEmbed',
				'insertTable',
				'blockQuote',
				'|',
				'bulletedList',
				'numberedList',
				'todoList',
				'outdent',
				'indent'
			],
			shouldNotGroupWhenFull: false
		},
		plugins: [
			Autoformat,
			AutoImage,
			Autosave,
			BlockQuote,
			Bold,
			CKBox,
			CKBoxImageEdit,
			CloudServices,
			Essentials,
			Heading,
			ImageBlock,
			ImageCaption,
			ImageInline,
			ImageInsert,
			ImageInsertViaUrl,
			ImageResize,
			ImageStyle,
			ImageTextAlternative,
			ImageToolbar,
			ImageUpload,
			Indent,
			IndentBlock,
			Italic,
			Link,
			LinkImage,
			List,
			ListProperties,
			MediaEmbed,
			Paragraph,
			PasteFromOffice,
			PictureEditing,
			Table,
			TableCaption,
			TableCellProperties,
			TableColumnResize,
			TableProperties,
			TableToolbar,
			TextTransformation,
			TodoList,
			Underline
		],
		cloudServices: {
			tokenUrl: CLOUD_SERVICES_TOKEN_URL
		},
		heading: {
			options: [
				{
					model: 'paragraph',
					title: 'Paragraph',
					class: 'ck-heading_paragraph'
				},
				{
					model: 'heading1',
					view: 'h1',
					title: 'Heading 1',
					class: 'ck-heading_heading1'
				},
				{
					model: 'heading2',
					view: 'h2',
					title: 'Heading 2',
					class: 'ck-heading_heading2'
				},
				{
					model: 'heading3',
					view: 'h3',
					title: 'Heading 3',
					class: 'ck-heading_heading3'
				},
				{
					model: 'heading4',
					view: 'h4',
					title: 'Heading 4',
					class: 'ck-heading_heading4'
				},
				{
					model: 'heading5',
					view: 'h5',
					title: 'Heading 5',
					class: 'ck-heading_heading5'
				},
				{
					model: 'heading6',
					view: 'h6',
					title: 'Heading 6',
					class: 'ck-heading_heading6'
				}
			]
		},
		image: {
			toolbar: [
				'toggleImageCaption',
				'imageTextAlternative',
				'|',
				'imageStyle:inline',
				'imageStyle:wrapText',
				'imageStyle:breakText',
				'|',
				'resizeImage',
				'|',
				'ckboxImageEdit'
			]
		},
		initialData:
			'Hello World',
		licenseKey: LICENSE_KEY,
		link: {
			addTargetToExternalLinks: true,
			defaultProtocol: 'https://',
			decorators: {
				toggleDownloadable: {
					mode: 'manual',
					label: 'Downloadable',
					attributes: {
						download: 'file'
					}
				}
			}
		},
		list: {
			properties: {
				styles: true,
				startIndex: true,
				reversed: true
			}
		},
		placeholder: 'Type or paste your content here!',
		table: {
			contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
		}
	};
});

onMounted(() => {
	isLayoutReady.value = true;
});

watchEffect(() => {
	if (config.value) {
		configUpdateAlert(config.value);
	}
});

/**
 * This function exists to remind you to update the config needed for premium features.
 * The function can be safely removed. Make sure to also remove call to this function when doing so.
 */
function configUpdateAlert(config) {
	if (configUpdateAlert.configUpdateAlertShown) {
		return;
	}

	const isModifiedByUser = (currentValue, forbiddenValue) => {
		if (currentValue === forbiddenValue) {
			return false;
		}

		if (currentValue === undefined) {
			return false;
		}

		return true;
	};

	const valuesToUpdate = [];

	configUpdateAlert.configUpdateAlertShown = true;

	if (!isModifiedByUser(config.cloudServices?.tokenUrl, '<YOUR_CLOUD_SERVICES_TOKEN_URL>')) {
		valuesToUpdate.push('CLOUD_SERVICES_TOKEN_URL');
	}

	if (valuesToUpdate.length) {
		window.alert(
			[
				'Please update the following values in your editor config',
				'to receive full access to Premium Features:',
				'',
				...valuesToUpdate.map(value => ` - ${value}`)
			].join('\n')
		);
	}
}
</script>
