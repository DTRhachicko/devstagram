import Dropzone from "dropzone";


Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {} //se crea un objeto
            imagenPublicada.size = 1234; //no importa el tamaño, pero dropzone lo necesita
            imagenPublicada.name = document.querySelector('[name="imagen"]').value; //el nombre de la imagen es el valor del campo oculto
    
            //opciones de dropzone
            this.options.addedfile.call(this, imagenPublicada);
            //se utiliza el metodo call por que se automanda a llamar la funcion, ya que si usamos bind, hay que llamarla nosotros
    
            //cargamos la imagen
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
    
            //cargamos las clases de la imagen
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

/*dropzone.on('sending', function(file, xhr, formData, ) {
    console.log(formData);
});*/

dropzone.on('success', function (file, response) {
   //console.log(response.imagen); //retorna el nombre de la imagen
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error', function (file, message) {
    console.log(message);
});

dropzone.on('removedfile', function () {
    //console.log('Archivo eliminado');
    document.querySelector('[name="imagen"]').value = ""
});