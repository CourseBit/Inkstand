var FileManagers = [];

var FileManager = (function(_name) {

    var name = _name;
    var currentDir = "";
    var currentList = [];
    var filesystem = null;
    var templates = {
        modal: Handlebars.compile($("#template-file-manager-modal").html()),
        file: Handlebars.compile($("#template-file-explorer-file").html()),
        fileSingle: Handlebars.compile($("#template-file-explorer-file-single").html()),
        breadcrumbs: Handlebars.compile($("#template-file-explorer-breadcrumbs").html())
    };
    var $modal;
    var $newFolderModal;

    // Make sure only one FileManager has this name
    for(var i in FileManagers) {
        if(FileManagers[i].getName() == name) {
            throw new Error("FileManager with name " + name + " already exists.");
        }
    }
    FileManagers.push(this);

    // Create modal for file manager
    var modalHtml = templates.modal({"name": name});
    $("body").append(modalHtml);

    $modal = $("#" + name + "-file-explorer-modal");
    $newFolderModal = $("#" + name + "-new-folder-modal");

    $modal.on("show.bs.modal", function() {
        var self = this;

        if(isFilesystemLoaded()) {
            changePage("files");
            // Should we jump back to home, or stay on last dir?
            changeDir("");
        } else {
            showLoader();
            getFilesystem(function(data) {
                filesystem = data;
                changeDir("");
                hideLoader();
            });
        }
    });

    $modal.find(".file-upload-form").on("submit", function(e) {
        e.preventDefault();

        $(this).find(".progress").removeClass("hidden");

        var $progressBar = $(this).find(".progress .progress-bar");

        var formData = new FormData(this);
        formData.append("currentDir", currentDir);

        $.ajax({
            type: "post",
            url: "/inkstand/web/app_dev.php/file/upload",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                changePage("files");
                $modal.find(".file-upload-form")[0].reset();
                refreshFilesystem();
            },
            xhr: function(){
                var xhr = $.ajaxSettings.xhr() ;
                xhr.upload.onprogress = function(evt){
                    var percent = Math.floor(evt.loaded/evt.total*100) + "%";
                    $progressBar.css("width", percent);
                    $progressBar.html(percent);
                };
                return xhr ;
            }
        });
    });

    $newFolderModal.find(".file-add-folder-form").on("submit", function(e) {
        e.preventDefault();

        var dirName = $(this).find('input[name=dir]').val();

        if(currentDir != "") {
            dirName = currentDir + "/" + dirName;
        }

        $.ajax({
            type: "post",
            url: "/inkstand/web/app_dev.php/file/new-folder",
            data: {"dir":dirName},
            success: function(data) {
                $newFolderModal.modal("hide");
                refreshFilesystem();
            }
        });
    });

    // Toolbar actions
    $modal.find(".file-toolbar .file-action-refresh").on("click", function() {
        refreshFilesystem();
    });
    $modal.find(".file-toolbar .file-action-upload").on("click", function() {
        if(currentDir == "") {
            $modal.find(".current-dir").html("Home");
        } else {
            $modal.find(".current-dir").html(currentDir);
        }

        changePage("upload");
    });

    $modal.find(".file-upload-cancel").on("click", function() {
        changePage("files");
        $modal.find(".file-upload-form")[0].reset();
    });

    $(document).on("click", "#" + name + "-file-explorer-modal .file-list", function(e) {
        var file = $(e.target).closest(".file").data("file");
        if(file.type == "dir") {
            changeDir(file.path);
        } else if(file.type == "file") {
            file.json = JSON.stringify(file);
            var fileSingleHtml = templates.fileSingle(file);
            $modal.find("div[data-page=file]").html(fileSingleHtml);

            changePage("file");
        }
    });

    $(document).on("click", "#" + name + "-file-explorer-modal .file-breadcrumbs a", function(e) {
        var dir = $(e.target).data("dir");
        changeDir(dir);
        changePage("files");
    });

    var getFilesystem = function(callback) {
        $.ajax({
            url: "/inkstand/web/app_dev.php/file/get-file-system",
            success: function(data) {
                console.log(data);
                callback(data);
            }
        })
    };

    var isFilesystemLoaded = function() {
        if(filesystem == null) {
            return false;
        }
        return true;
    };

    var showLoader = function() {
        $modal.find(".file-loader").removeClass("hidden");
    };
    var hideLoader = function() {
        $modal.find(".file-loader").addClass("hidden");
    };

    var getName = function() {
        return name;
    };

    var changeDir = function(dirname) {
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
        var breadcrumbHtml = templates.breadcrumbs({"folderPathLinks": folderPathLinks});
        $modal.find(".file-breadcrumbs").html(breadcrumbHtml);


        $modal.find(".file-list").empty();

        for(var fileIndex in currentList) {
            if(currentList.hasOwnProperty(fileIndex)) {
                var file = currentList[fileIndex];

                if(file.type == "file") {
                    file.icon = "file-o";
                } else if(file.type == "dir") {
                    file.icon = "folder-o";
                }

                file.json = JSON.stringify(file);

                var fileHtml = templates.file(file);
                $modal.find(".file-list").append(fileHtml);
            }
        }
    };

    var getFolderPathLinks = function(dir) {
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

        return folderPathLinks;
    };

    var changePage = function(page) {
        $modal.find(".modal-page").addClass("hidden");

        $modal.find(".modal-page[data-page=" + page + "]").removeClass("hidden");
    };

    var refreshFilesystem = function() {
        $modal.find(".file-list").empty();

        showLoader();
        getFilesystem(function(data) {
            filesystem = data;
            changeDir(currentDir);
            hideLoader();
        });
    };

    var chooseFile = function(callback) {

        $modal.modal("show");

        $(document).on("click", "#" + name + "-file-explorer-modal .file-choose", function(e) {
            var file = $(e.target).data("file");
            $modal.modal("hide");
            callback(file);
        });
    };

    return {
        getName: getName,
        chooseFile: chooseFile
    }
});

var defaultFileManager = new FileManager("default");

$(document).on("click", ".file-picker button", function(e) {
    defaultFileManager.chooseFile(function(file) {
        $(e.target).closest(".file-picker").find("input").val(file.path);
    });
});


