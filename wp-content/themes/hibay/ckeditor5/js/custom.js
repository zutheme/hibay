var _editor = document.querySelector( '.editor');
let _editors = document.getElementsByClassName("editor");
//let _editors = document.getElementsByTagName('textarea');
for (var i = 0; i < _editors.length; i++) {
	ClassicEditor
			.create(_editors[i], {
				fontSize: {
		            options: [
		                9,
		                11,
		                13,
		                15,
		                17,
		                19,
		                21
		            ]
		        },
				toolbar: {
					items: [
						'heading',
						'bold',
						'italic',
						'fontBackgroundColor',
						'underline',
						'fontColor',
						'|',
						'fontSize',
						'fontFamily',
						'htmlEmbed',
						'removeFormat',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'blockQuote',
						'undo',
						'redo'
					]
				},
				language: 'en',
				licenseKey: '',
				
				
			} )
			.then( newEditor => {
				window.editor = newEditor;
				data_editor = newEditor;
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: i6viqs6ovgfv-seqoqvzhjuqz' );
				console.error( error );
			} );
}

	function getdata(){
		const editorData = data_editor.getData();
		alert(editorData);
		console.log(editorData);
	}
var show = false;		
function showslide(element){
	var eslide = document.getElementsByClassName("slide");
	for (var i = 0; i < eslide.length; i++) {
		eslide[i].style.display = 'none';
	}
	var parent = element.parentElement.parentElement;
	console.log(parent);
	var _id_slide = parent.getElementsByClassName("slide")[0];
	if(!show){
		_id_slide.style.display = "block";
		show = true;
	}else{
		_id_slide.style.display = "none";
		show = false;
	}
	
}