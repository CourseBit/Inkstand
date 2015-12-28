
var currentDir = "";
var currentList = [];
var filesystem = null;

var fileTemplate = Handlebars.compile($("#template-file-explorer-file").html());
var breadcrumbsTemplate = Handlebars.compile($("#template-file-explorer-breadcrumbs").html());

$(document).ready(function() {
    $("#file-explorer-modal").on("show.bs.modal", function() {
        if(filesystem == null) {
            getFilesystem(function() {
                changeDir("");
            });
        }
    });

    $(document).on("click", "#file-explorer-modal .file-list", function(e) {
        var file = $(e.target).closest(".file").data("file");
        if(file.type == "dir") {
            changeDir(file.path);
        }
    });
});

function getFilesystem(callback) {
    $.ajax({
        url: "/inkstand/web/app_dev.php/file/get-file-system",
        success: function(data) {
            filesystem = data;
            callback(data);
        }
    })
}

function changeDir(dirname) {
    currentDir = dirname;
    currentList = [];
    for(var fileIndex in filesystem) {
        if(filesystem.hasOwnProperty(fileIndex)) {
            var file = filesystem[fileIndex];
            if(file.dirname == currentDir) {
                currentList.push(file);
            }
        }
    }

    var folderPathLinks = getFolderPathLinks(currentDir);
    var breadcrumbHtml = breadcrumbsTemplate({"folderPathLinks": folderPathLinks});
    $("#file-explorer-modal .file-breadcrumbs").html(breadcrumbHtml);


    $("#file-explorer-modal .file-list").empty();

    for(var fileIndex in currentList) {
        if(currentList.hasOwnProperty(fileIndex)) {
            var file = currentList[fileIndex];

            if(file.type == "file") {
                file.icon = "file-o";
            } else if(file.type == "dir") {
                file.icon = "folder-o";
            }

            file.json = JSON.stringify(file);

            var fileHtml = fileTemplate(file);
            $("#file-explorer-modal .file-list").append(fileHtml);
        }
    }
}

function getFolderPathLinks(dir) {
    var folderPathLinks = [];
    var tempPath = [];
    var paths = dir.split("/");

    var pathLink = {};
    pathLink.dirName = "Home";
    pathLink.dir = "";
    folderPathLinks.push(pathLink);

    if(paths[0]) {
        for (var pathIndex in paths) {
            var path = paths[pathIndex];
            console.log(path);
            var pathLink = {};
            pathLink.dirName = path;
            tempPath.push(path);
            pathLink.dir = tempPath.join("/");
            folderPathLinks.push(pathLink);
        }
    }

    console.log(paths);

    console.log(folderPathLinks);

    return folderPathLinks;
}