var FileManagers = [];

var FileManager = (function(_name) {

    var properties = {
        name: _name,
        filesystems: null,
        currentFilesystemName: null,
        templates: {
            modal: Handlebars.compile($("#template-file-manager-modal").html()),
            fileList: Handlebars.compile($("#template-file-explorer-file-list").html()),
            fileSingle: Handlebars.compile($("#template-file-explorer-file-single").html()),
            fileTabs: Handlebars.compile($("#template-file-tabs").html())
        },
        $modal: null,
        $newFolderModal: null
    };

    // Make sure only one FileManager has this name
    for(var i in FileManagers) {
        if(FileManagers[i].getName() == properties.name) {
            throw new Error("FileManager with name " + properties.name + " already exists.");
        }
    }
    FileManagers.push(this);

    // Create modal for file manager
    var modalHtml = properties.templates.modal({"name": properties.name});
    $("body").append(modalHtml);

    properties.$modal = $("#" + properties.name + "-file-explorer-modal");
    properties.$newFolderModal = $("#" + properties.name + "-new-folder-modal");

    properties.$modal.on("show.bs.modal", function() {
        showLoader();

        getFilesystems(function(data) {
            properties.filesystems = data;
            console.log(data);
            renderTabs();
            hideLoader();
            if(properties.filesystems) {
                properties.$modal.find("a[data-toggle=tab]").first().tab("show");
            }
        });
    });

    properties.$modal.on("show.bs.tab", "a[data-toggle=tab]", function (e) {
        //e.target // newly activated tab
        //e.relatedTarget // previous active tab
        var filesystemName = $(e.target).data("filesystem");
        var filesystem = getFilesystem(filesystemName);
        setCurrentFilesystem(filesystem.name);
        renderDir(filesystem);
    });

    var renderTabs = function() {
        var tabsHtml = properties.templates.fileTabs({"filesystems":properties.filesystems});
        properties.$modal.find(".file-tabs").html(tabsHtml);
    };

    var renderDir = function(filesystem) {
        var fileList = [];

        for(var i in filesystem.contents) {
            if(filesystem.contents[i].dirname == filesystem.currentDir) {
                var file = filesystem.contents[i];

                if(file.type == "file") {
                    file.icon = "file-o";
                } else if(file.type == "dir") {
                    file.icon = "folder-o";
                }

                file.json = JSON.stringify(file);
                fileList.push(file);
            }
        }

        var folderPathLinks = getFolderPathLinks(filesystem.currentDir);

        var fileListHtml = properties.templates.fileList({"fileList": fileList, "folderPathLinks": folderPathLinks});
        $("#tab-filesystem-" + filesystem.name).html(fileListHtml);
    };

    var renderFile = function(file, filesystem) {
        file.json = JSON.stringify(file);
        var fileSingleHtml = properties.templates.fileSingle({"file":file, "folderPathLinks":getFolderPathLinks(file.dirname)});
        $("#tab-filesystem-" + filesystem.name).html(fileSingleHtml);
    };

    properties.$modal.find(".file-upload-form").on("submit", function(e) {
        e.preventDefault();

        $(this).find(".progress").removeClass("hidden");

        var $progressBar = $(this).find(".progress .progress-bar");

        var formData = new FormData(this);
        formData.append("currentDir", getCurrentFilesystem().currentDir);
        formData.append("filesystemName", getCurrentFilesystem().name);

        $.ajax({
            type: "post",
            url: "/inkstand/web/app_dev.php/file/upload",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                changePage("files");
                properties.$modal.find(".file-upload-form")[0].reset();
                refreshFilesystems();
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

    properties.$newFolderModal.find(".file-add-folder-form").on("submit", function(e) {
        e.preventDefault();

        var dirName = $(this).find('input[name=dir]').val();

        if(getCurrentFilesystem().currentDir != "") {
            dirName = getCurrentFilesystem().currentDir + "/" + dirName;
        }

        $.ajax({
            type: "post",
            url: "/inkstand/web/app_dev.php/file/new-folder",
            data: {"dir":dirName, "filesystemName":getCurrentFilesystem().name},
            success: function(data) {
                properties.$newFolderModal.modal("hide");
                refreshFilesystems();
            }
        });
    });
    //
    // Toolbar actions
    properties.$modal.find(".file-toolbar .file-action-refresh").on("click", function(e) {
        $(e.target).closest(".file-action-refresh").find("i").addClass("fa-spin");
        refreshFilesystems(function() {
            $(e.target).closest(".file-action-refresh").find("i").removeClass("fa-spin");
        });
    });
    properties.$modal.find(".file-toolbar .file-action-upload").on("click", function() {
        if(getCurrentFilesystem().currentDir == "") {
            properties.$modal.find(".current-dir").html("Home");
        } else {
            properties.$modal.find(".current-dir").html(getCurrentFilesystem().currentDir);
        }

        changePage("upload");
    });
    //
    //$modal.find(".file-upload-cancel").on("click", function() {
    //    changePage("files");
    //    $modal.find(".file-upload-form")[0].reset();
    //});
    //
    properties.$modal.on("click", ".file", function(e) {
        var file = $(e.target).closest(".file").data("file");

        if(file.type == "dir") {
            changeDir(file.path);
            renderDir(getCurrentFilesystem());
        } else if(file.type == "file") {
            renderFile(file, getCurrentFilesystem());
        }
    });

    properties.$modal.on("click", ".breadcrumb a", function(e) {
        var dir = $(e.target).data("dir");
        changeDir(dir);
        renderDir(getCurrentFilesystem());
        changePage("files");
    });

    var getFilesystems = function(callback) {
        $.ajax({
            url: "/inkstand/web/app_dev.php/file/get-filesystems",
            success: function(data) {
                callback(data);
            }
        })
    };

    var getFilesystem = function(name) {
        for(var i in properties.filesystems) {
            if(properties.filesystems[i].name == name) {
                return properties.filesystems[i];
            }
        }
    };

    var getCurrentFilesystem = function() {
        for(var i in properties.filesystems) {
            if(properties.filesystems[i].name == properties.currentFilesystemName) {
                return properties.filesystems[i];
            }
        }
    };

    var setCurrentFilesystem = function(name) {
        properties.currentFilesystemName = name;
    }

    var isFilesystemLoaded = function() {
        if(filesystems == null) {
            return false;
        }
        return true;
    };

    var showLoader = function() {
        properties.$modal.find(".file-loader").removeClass("hidden");
    };
    var hideLoader = function() {
        properties.$modal.find(".file-loader").addClass("hidden");
    };

    var getName = function() {
        return name;
    };

    var changeDir = function(dirname, filesystem) {
        if(!filesystem) {
            filesystem = getCurrentFilesystem();
        }

        filesystem.currentDir = dirname;
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
        properties.$modal.find(".modal-page").addClass("hidden");

        properties.$modal.find(".modal-page[data-page=" + page + "]").removeClass("hidden");
    };

    var refreshFilesystems = function(callback) {
        //$modal.find(".file-list").empty();

        var currentDir = getCurrentFilesystem().currentDir;

        getFilesystems(function(data) {
            properties.filesystems = data;
            var currentFilesystem = getCurrentFilesystem();
            currentFilesystem.currentDir = currentDir;
            renderDir(currentFilesystem);
            if(callback) {
                callback(data);
            }
        });
    };

    var chooseFile = function(supportedFormats, callback) {

        properties.$modal.modal("show");

        properties.$modal.on("click", ".file-choose", function(e) {
            var file = $(e.target).data("file");
            console.log(supportedFormats);
            console.log(file.extension);
            if(supportedFormats.indexOf(file.extension) > 0) {
                properties.$modal.modal("hide");
                callback(file, getCurrentFilesystem());
            } else {
                alert("You must choose a file of the follow: " + supportedFormats.join(", "));
            }
        });
    };

    return {
        getName: getName,
        chooseFile: chooseFile
    }
});

var defaultFileManager = new FileManager("default");

$(document).on("click", ".file-picker button", function(e) {
    defaultFileManager.chooseFile(["png", "jpg", "gif"], function(file, filesystem) {
        var $formGroup = $(e.target).closest(".form-group").parent().closest(".form-group");
        $formGroup.find("input[data-file=filesystemId]").val(filesystem.filesystemId);
        $formGroup.find("input[data-file=path]").val(file.path);
    });
});