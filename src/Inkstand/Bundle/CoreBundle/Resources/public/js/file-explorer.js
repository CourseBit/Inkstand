
var currentDir = "";
var currentList = [];
var filesystem = null;

$(document).ready(function() {
    getFilesystem();
    changeDir("");
});

function getFilesystem() {
    $.ajax({
        url: "/inkstand/web/app_dev.php/file/get-file-system",
        success: function(data) {
            filesystem = data;
        }
    })
}

function changeDir(dirname) {
    currentDir = dirname;
    $.each(filesystem, function(index, value) {
        if(value.dirname == currentDir) {
            console.log(value);
            currentList.push(value);
        }
    });
}