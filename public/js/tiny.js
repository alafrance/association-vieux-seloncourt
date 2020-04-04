
tinymce.init({
  selector: 'textarea',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  language: 'fr_FR',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: '',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify  |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | insertfile image media link',
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  fontsize_formats: '10px 11px 12px 13px 14px 15px 20px 28px 40px 45px 50px 75px',
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: true,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
  importcss_append: true,
  height: 800,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h1 h2 h3 blockquote quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  quickbars_insert_toolbar : '',
// enable title field in the Image dialog
  image_title: true,
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // add custom filepicker only to Image dialog
  file_picker_types: 'image',
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();

      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    input.click();
  }
});

// Evenement qui se lance en même temps que le DOM
document.addEventListener('DOMContentLoaded',function(){
  // On recupère l'input type file
  var fileInput = document.querySelector('[type=file]');
  // Au changement de l'input :
  fileInput.addEventListener('change', function(event){
    // Initialisation
    let inputFile = event.currentTarget.files[0];
    let file = inputFile.name;
    let allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
    let Reader = new FileReader();
    let imgElement = document.createElement('img');

    // On vérifie que la partie extension est juste
    imgType = file.split('.')[1];
    if(allowedTypes.indexOf(imgType) != -1) {
      // Si elle est juste on load le fichier
      document.getElementById('preview-file').innerHTML= '';
      Reader.addEventListener('load', function(){
        imgElement.classList.add('imgPreview');
        imgElement.src = this.result;
        document.getElementById('preview-file').appendChild(imgElement);
      })

      Reader.readAsDataURL(inputFile);
    }
  }, false);
});


