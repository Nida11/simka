var Enum_Demos = {
    'helloworld': 'demo01',
    'useevent': 'demo02',
    'sourcelist': 'demo03',
    'withoutui': 'demo04',
    'autofeeder': 'demo05',
    'scanandsave': 'demo16',
    'customscan': 'demo06',
    'loadlocal': 'demo13',
    'saveimage': 'demo14',
    'httpupload': 'demo07',
    'sendextrainfo': 'demo17',
    'httpdownload': 'demo12',
    'showeditor': 'demo10',
    'customedit': 'demo11',
    'navigation': 'demo08',
    'thumbnails': 'demo09',
    'rasterizer': 'demo19',
    'serversideocr': 'demo20',
    'clientsideocr': 'demo23',
    'scanbarcode': 'demo21',
	'scanwebcam': 'demo22',
    'mobilecamera': 'demo24'
},
    aryDemo = {
        categories:
            [
                {
                    name: "Get Started", type: "core", demos:
                        [
                            {
                                name: "Hello World",
                                API: [
                                    {
                                        name: "SelectSource()", APILink: "Documents/Help/Methods/method%20SelectSource.htm"
                                    },
                                    {
                                        name: "OpenSource()", APILink: "Documents/Help/Methods/method%20OpenSource.htm"
                                    },
                                    {
                                        name: "AcquireImage()", APILink: "Documents/Help/Methods/method%20AcquireImage.htm"
                                    }],
                                desc: "Hello World of Dynamic Web TWAIN", link: "Samples/Getting Started/HelloWorld.html", className: Enum_Demos.helloworld, screenshotLink: ""
                            },
                            {
                                name: "Use Event",
                                API: [
                                    {
                                        name: "OnWebTwainReady", APILink: "Documents/Help/Events/Event%20OnWebTwainReady.htm"
                                    },
                                    {
                                        name: "OnPostAllTransfers", APILink: "Documents/Help/Events/Event%20OnPostAllTransfers.htm"
                                    },
                                    {
                                        name: "Width", APILink: "Documents/Help/Properties/prop%20Width.htm"
                                    },
                                    {
                                        name: "Height", APILink: "Documents/Help/Properties/prop%20Height.htm"
                                    }],
                                desc: "Register built-in Dynamic Web TWAIN Events", link: "Samples/Getting Started/UseEvent.html", className: Enum_Demos.useevent, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "Scan", type: "core", demos:
                        [
                            {
                                name: 'Scan from source list',
                                API: [
                                    {
                                        name: "AcquireImage()", APILink: "Documents/Help/Methods/method%20AcquireImage.htm"
                                    },
                                    {
                                        name: "SelectSourceByIndex()", APILink: "Documents/Help/Methods/method%20SelectSourceByIndex.htm"
                                    }],
                                desc: "Scan images from a source in the drop down menu", link: "Samples/Scan/SourceList.html", className: Enum_Demos.sourcelist, screenshotLink: ""
                            },
                            {
                                name: 'Scan without UI',
                                API: [
                                    {
                                        name: "IfShowUI", APILink: "Documents/Help/Properties/prop%20IfShowUI.htm"
                                    }],
                                desc: "Scan images with or without scanner UI", link: "Samples/Scan/ScanWithoutUI.html", className: Enum_Demos.withoutui, screenshotLink: ""
                            },
                            {

                                name: 'Scan with autofeeder',
                                API: [
                                    {
                                        name: "IfFeederEnabled", APILink: "Documents/Help/Properties/prop%20IfFeederEnabled.htm"
                                    }],
                                desc: "Scan images with or without feeder enabled", link: "Samples/Scan/AutoFeeder.html", className: Enum_Demos.autofeeder, screenshotLink: ""
                            },
                            {
                                name: 'Scan and Save',
                                API: [
                                    {
                                        name: "OnPostAllTransfers", APILink: "Documents/Help/Events/Event%20OnPostAllTransfers.htm"
                                    },
                                    {
                                        name: "OnPostTransfer", APILink: "Documents/Help/Events/Event%20OnPostTransfer.htm"
                                    },
                                    {
                                        name: "SaveAsJPEG()", APILink: "Documents/Help/Methods/method%20SaveAsJPEG.htm"
                                    },
                                    {
                                        name: "SaveAllAsMultiPageTIFF()", APILink: "Documents/Help/Methods/method%20SaveAllAsMultiPageTIFF.htm"
                                    },
                                    {
                                        name: "SaveAllAsPDF()", APILink: "Documents/Help/Methods/method%20SaveAllAsPDF.htm"
                                    }],
                                desc: "Scan image(s) and save them automatically", link: "Samples/Load Save/SaveImages.html", className: Enum_Demos.scanandsave, screenshotLink: ""
                            },
                            {
                                name: 'Custom Scan',
                                API: [
                                    {
                                        name: "Resolution", APILink: "Documents/Help/Properties/prop%20Resolution.htm"
                                    },
                                    {
                                        name: "PixelType", APILink: "Documents/Help/Properties/prop%20PixelType.htm"
                                    },
                                    {
                                        name: "IfShowUI", APILink: "Documents/Help/Properties/prop%20IfShowUI.htm"
                                    },
                                    {
                                        name: "IfFeederEnabled", APILink: "Documents/Help/Properties/prop%20IfFeederEnabled.htm"
                                    }],
                                desc: "Scan image with customized resolution and pixel type", link: "Samples/Scan/CustomScan.html", className: Enum_Demos.customscan, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "Load Save", type: "core", demos:
                        [
                            {
                                name: 'Load local',
                                API: [
                                    {
                                        name: "LoadImageEx()", APILink: "Documents/Help/Methods/method%20LoadImageEx.htm"
                                    }],
                                desc: "Load image(s) from local drive", link: "Samples/Load Save/SaveImages.html", className: Enum_Demos.loadlocal, screenshotLink: ""
                            },
                            {
                                name: 'Save image',
                                API: [
                                    {
                                        name: "OnPostAllTransfers", APILink: "Documents/Help/Events/Event%20OnPostAllTransfers.htm"
                                    },
                                    {
                                        name: "OnPostTransfer", APILink: "Documents/Help/Events/Event%20OnPostTransfer.htm"
                                    },
                                    {
                                        name: "SaveAsJPEG()", APILink: "Documents/Help/Methods/method%20SaveAsJPEG.htm"
                                    },
                                    {
                                        name: "SaveAllAsMultiPageTIFF()", APILink: "Documents/Help/Methods/method%20SaveAllAsMultiPageTIFF.htm"
                                    },
                                    {
                                        name: "SaveAllAsPDF()", APILink: "Documents/Help/Methods/method%20SaveAllAsPDF.htm"
                                    }],
                                desc: "Scan or load image(s) and save them automatically", link: "Samples/Load Save/SaveImages.html", className: Enum_Demos.saveimage, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "Upload Download", type: "core", demos:
                        [
                            {
                                name: 'HTTP Upload',
                                API: [
                                    {
                                        name: "HTTPUploadThroughPost()", APILink: "Documents/Help/Methods/method%20HTTPUploadThroughPost.htm"
                                    },
                                    {
                                        name: "HTTPUploadAllThroughPostAsMultiPageTIFF()", APILink: "Documents/Help/Methods/method%20HTTPUploadAllThroughPostAsMultiPageTIFF.htm"
                                    },
                                    {
                                        name: "HTTPUploadAllThroughPostAsPDF()", APILink: "Documents/Help/Methods/method%20HTTPUploadAllThroughPostAsPDF.htm"
                                    }],
                                desc: "Upload images to the server", link: "Samples/Upload Download/Visual Studio Demo/UploadWithHTTP.html", className: Enum_Demos.httpupload, screenshotLink: "Documents/res/Images/UploadWithHTTP.png"
                            },
                            {
                                name: 'Send extra info',
                                API: [
                                    {
                                        name: "ClearAllHTTPFormField()", APILink: "Documents/Help/Methods/method%20ClearAllHTTPFormField.htm"
                                    },
                                    {
                                        name: "SetHTTPFormField()", APILink: "Documents/Help/Methods/method%20SetHTTPFormField.htm"
                                    }],
                                desc: "Send Extra info with the images to the server", link: "Samples/Upload Download/Visual Studio Demo/SendExtraInfo.html", className: Enum_Demos.sendextrainfo, screenshotLink: "Documents/res/Images/SendExtraInfo.png"
                            },
                            {
                                name: 'HTTP Download',
                                API: [{
                                    name: "HTTPDownload()", APILink: "Documents/Help/Methods/method%20HTTPDownload.htm"
                                }],
                                desc: "Download images from the server", link: "Samples/Upload Download/Visual Studio Demo/DownloadWithHTTP.html", className: Enum_Demos.httpdownload, screenshotLink: "Documents/res/Images/DownloadWithHTTP.png"
                            }
                        ]
                },
                {
                    name: "Edit", type: "core", demos:
                        [
                            {
                                name: 'Show editor',
                                API: [
                                    {
                                        name: "ShowImageEditor()", APILink: "Documents/Help/Methods/method%20ShowImageEditor.htm"
                                    }],
                                desc: "Show Dynamic Web TWAIN's built-in image editor", link: "Samples/Edit/ShowEditor.html", className: Enum_Demos.showeditor, screenshotLink: ""
                            },
                            {
                                name: 'Custom edit',
                                API: [
                                    {
                                        name: "RotateLeft()", APILink: "Documents/Help/Methods/method%20RotateLeft.htm"
                                    },
                                    {
                                        name: "RotateRight()", APILink: "Documents/Help/Methods/method%20RotateRight.htm"
                                    },
                                    {
                                        name: "Mirror()", APILink: "Documents/Help/Methods/method%20Mirror.htm"
                                    },
                                    {
                                        name: "Flip()", APILink: "Documents/Help/Methods/method%20Flip.htm"
                                    },
                                    {
                                        name: "HowManyImagesInBuffer", APILink: "Documents/Help/Properties/prop%20HowManyImagesInBuffer.htm"
                                    }],
                                desc: "Rotate, mirror or flip an image", link: "Samples/Edit/Edit.html", className: Enum_Demos.customedit, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "Display", type: "core", demos:
                        [
                            {
                                name: 'Navigation',
                                API: [
                                    {
                                        name: "SetViewMode()", APILink: "Documents/Help/Methods/method%20SetViewMode.htm"
                                    },
                                    {
                                        name: "OnMouseClick", APILink: "Documents/Help/Events/Event%20OnMouseClick.htm"
                                    },
                                    {
                                        name: "CurrentImageIndexInBuffer", APILink: "Documents/Help/Properties/prop%20CurrentImageIndexInBuffer.htm"
                                    },
                                    {
                                        name: "HowManyImagesInBuffer", APILink: "Documents/Help/Properties/prop%20HowManyImagesInBuffer.htm"
                                    }],
                                desc: "Navigate images with custom preview mode", link: "Samples/Display/Navigation.html", className: Enum_Demos.navigation, screenshotLink: ""
                            },
                            {
                                name: 'Thumbnail',
                                API: [
                                    {
                                        name: "CopyToClipboard()", APILink: "Documents/Help/Methods/method%20CopyToClipboard.htm"
                                    },
                                    {
                                        name: "LoadDibFromClipboard()", APILink: "Documents/Help/Methods/method%20LoadDibFromClipboard.htm"
                                    },
                                    {
                                        name: "OnWebTwainReady", APILink: "Documents/Help/Events/Event%20OnWebTwainReady.htm"
                                    },
                                    {
                                        name: "OnPostTransfer", APILink: "Documents/Help/Events/Event%20OnPostTransfer.htm"
                                    },
                                    {
                                        name: "OnPostLoad", APILink: "Documents/Help/Events/Event%20OnPostLoad.htm"
                                    },
                                    {
                                        name: "OnMouseClick", APILink: "Documents/Help/Events/Event%20OnMouseClick.htm"
                                    }],
                                desc: "Thumbnails sample with two controls", link: "Samples/Thumbnail/Thumbnail.html", className: Enum_Demos.thumbnails, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "PDF Rasterizer", type: "addon", demos:
                        [
                            {
                                name: 'PDF Rasterizer',
                                bExternalLink: false,
                                API: [
                                    {
                                        name: "Addon.PDF.Download()", APILink: "Documents/Help/Methods/method%20Addon.PDF.Download.htm"
                                    },
                                    {
                                        name: "Addon.PDF.SetResolution()", APILink: "Documents/Help/Methods/method%20Addon.PDF.SetResolution.htm"
                                    },
                                    {
                                        name: "Addon.PDF.SetConvertMode()", APILink: "Documents/Help/Methods/method%20Addon.PDF.SetConvertMode.htm"
                                    },
                                    {
                                        name: "LoadImageEx()", APILink: "Documents/Help/Methods/method%20LoadImageEx.htm"
                                    }],
                                desc: "PDF Rasterizer", link: "Samples/PDFRasterizer/PDFRasterizer.html", className: Enum_Demos.rasterizer, screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "OCR", type: "addon", demos:
                        [
                            {
                                name: 'Server-side OCR',
                                bExternalLink: false,
                                API: "",
                                desc: "Scan and Server-side OCR",
                                link: "",
                                className: Enum_Demos.serversideocr,
                                screenshotLink: "Documents/res/Images/ScanAndOCR.png"
                            }
                        ]
                },
                {
                    name: "OCRB", type: "addon", demos:
                        [
                            {
                                name: 'Client-side OCR',
                                bExternalLink: false,
                                API: "",
                                desc: "Scan and Do client-side OCR",
                                link: "Samples/OCRBasic/OCRBasicClientSide.html",
                                className: Enum_Demos.clientsideocr,
                                screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "Scan+Barcode", type: "addon", demos:
                        [
                            {
                                name: 'Scan + Barcode',
                                //bExternalLink: true,
                                API: "",
                                desc: "Scan and read barcode",
                                link: "Samples/Scan+Barcode/online_demo_scan_Barcode.html",
                                className: Enum_Demos.scanbarcode,
                                screenshotLink: ""
                            }
                        ]
                },
				 {
                    name: "Scan+Webcam", type: "addon", demos:
                        [
                            {
                                name: 'Scan + Webcam',
                                //bExternalLink: true,
                                API: "",
                                desc: "Acquire with scanners and cameras",
                                link: "Samples/Scan+Webcam/online_demo_scan_Webcam.html",
                                className: Enum_Demos.scanwebcam,
                                screenshotLink: ""
                            }
                        ]
                },
                {
                    name: "MobileCamera", type: "addon", demos:
                        [
                            {
                                name: 'Mobile Camera Capture',
                                //bExternalLink: true,
                                API: "",
                                desc: "Acquire with mobile cameras",
                                link: "Samples/MobileCamera/mobilebrowsercapture.html",
                                className: Enum_Demos.mobilecamera,
                                screenshotLink: ""
                            }
                        ]
                }
            ]
    };

function loadDemos() {
    $("#goback").live("click", function () {
        $(".demo a")[0].click();
    });
    $("#demoCat").empty();
    $("#demoAddonCat").empty();
    for (var i = 0; i < aryDemo.categories.length; i++) {
        if (aryDemo.categories[i].demos != null) {
            if (aryDemo.categories[i].type == "addon") {
                for (var j = 0; j < aryDemo.categories[i].demos.length; j++) {
                    var o = aryDemo.categories[i].demos[j];
                    if (o.bExternalLink) {
                        $("#demoAddonCat").append("<li><a href='" + o.link + "' target='_blank'>" + o.name + "</a></li>");
                    }
                    else {
                        $("#demoAddonCat").append("<li class='demo'><a class='" + o.className + "'>" + o.name + "</a></li>");
                    }
                }
            }
            else {
                var strList = "";
                for (var g = 0; g < aryDemo.categories[i].demos.length; g++) {
                    strList += "<li class='demo'><a class='" + aryDemo.categories[i].demos[g].className + "'>" + aryDemo.categories[i].demos[g].name + "</a></li>";
                }
                if (i == 0) {
                    $("#demoCat").append("<li class='liCat expand'><span>" + aryDemo.categories[i].name + "<i class='fa fa-angle-up'></i></span><ul class='demoList'>" + strList + "</ul></li>");
                }
                else {
                    $("#demoCat").append("<li class='liCat'><span>" + aryDemo.categories[i].name + "<i class='fa fa-angle-down'></i></span><ul class='demoList'>" + strList + "</ul></li>");
                }
            }
        }
    }
}

// collapse demos
$("#demoCat li.liCat span").live("click", function () {
    var o = $(this);
    o.parent(".liCat").toggleClass("expand");
    o = o.children();
    if (o.hasClass('fa-angle-up')) {
        o.removeClass('fa-angle-up');
        o.addClass('fa-angle-down');
    } else {
        o.removeClass('fa-angle-down');
        o.addClass('fa-angle-up');
    }
});


$(".demo a").live("click", function () {
    var currentDemo = $(this).attr("class");
    $(".catList li").removeClass("CurrentDemo");
    $(this).closest("li").addClass("CurrentDemo");
    $(".demoCode").hide();
    var strPath = window.location.href;
    strPath = strPath.substring(0, strPath.lastIndexOf("/") + 1);
    var _href = '';
    for (var i = 0; i < aryDemo.categories.length; i++) {
        for (var j = 0; j < aryDemo.categories[i].demos.length; j++) {
            if (aryDemo.categories[i].demos[j].className == currentDemo) {
                $("#demoDesc").html(aryDemo.categories[i].demos[j].desc);
                if (currentDemo == Enum_Demos.scanbarcode || currentDemo == Enum_Demos.scanwebcam || currentDemo == Enum_Demos.clientsideocr) {
                    var _width = '1039px', demoMargin = '0px', _height = '900px';
                    if (currentDemo == Enum_Demos.clientsideocr)
                        _height = '920px';
                    if (currentDemo == Enum_Demos.scanwebcam) {
                        _width = '1121px';
                        demoMargin = '0 0 0 -40px';
                    }
                    $("#goback").show();
                    $("#demoDesc").parent().css('display', 'none');
                    $('#sidebar').css('display', 'none');
                    $('#sampleContent').css({
                        'width': '1039px',
                        'margin-left': '0px',
                        'overflow': 'hidden'
                    });
                    $('.demo-main').css({
                        'width': _width,
                        'margin': demoMargin,
                        'border': '0px',
                        'padding': '0px',
                        'overflow': 'hidden'
                    });
                    $("#frmDemo").css({
                        "margin-top": '-5px',
                        "width": $("#frmDemo").parent().css("width"),
                        "height": _height
                    });
                    $("#Samples").css({
                        'width': '1039px',
                        'margin': '0'
                    });
                    $(".description").css({
                        'margin-left': '50px'
                    });
                } else {
                    $("#goback").hide();
                    $("#demoDesc").parent().css('display', '');
                    $('#sidebar').css('display', 'block');
                    $('#sampleContent').css({
                        'width': '715px',
                        'margin-left': '47px'
                    });
                    $('.demo-main').css({
                        'width': '700px',
                        'margin': '20px 0',
                        'border': '1px solid #ddd',
                        'padding': '5px'
                    });
                    $("#frmDemo").css({
                        "width": parseInt($("#frmDemo").parent().css("width")) - 10 + "px",
                        "height": '500px'
                    });
                    $("#Samples").css({
                        'width': '940px',
                        'margin': '0 0 0 35px'
                    });
                    $(".description").css({
                        'margin-left': '0px'
                    });
                }
                if (currentDemo == Enum_Demos.serversideocr || currentDemo == Enum_Demos.scanbarcode || currentDemo == Enum_Demos.scanwebcam || currentDemo == Enum_Demos.clientsideocr || currentDemo == Enum_Demos.mobilecamera) {
                    $('.description').hide();
                } else {
                    $('.description').show();
                }
                /******************If non-IE on Win, view source******************/
                ua = (navigator.userAgent.toLowerCase());
                if (ua.indexOf("msie") == -1 && ua.indexOf('trident') == -1)
                    _href = /*"view-source:" + */strPath;
                /*****************************************************************/
                if (aryDemo.categories[i].demos[j].link != "")
                    $("#demoLink").html("The complete source code can be found at <a style='text-decoration: underline; font-weight: bold' href='" + _href + aryDemo.categories[i].demos[j].link + "' target='_blank'>" + strPath + aryDemo.categories[i].demos[j].link + "</a>");
                else
                    $("#demoLink").html("");
                if (aryDemo.categories[i].demos[j].screenshotLink == "") {
                    $("#frmDemo").attr("src", aryDemo.categories[i].demos[j].link);
                }
                else {
                    $("#frmDemo").attr("src", aryDemo.categories[i].demos[j].screenshotLink);
                }
                var strAPI = "";
                if (aryDemo.categories[i].demos[j].API != "") {
                    for (var k = 0; k < aryDemo.categories[i].demos[j].API.length; k++) {
                        if (strAPI != "") {
                            strAPI += ", ";
                        }
                        if (aryDemo.categories[i].demos[j].API[k].APILink != null) {
                            strAPI += "<a href='" + aryDemo.categories[i].demos[j].API[k].APILink + "' target='_blank'>" + aryDemo.categories[i].demos[j].API[k].name + "</a>";
                        }
                        else {
                            strAPI += aryDemo.categories[i].demos[j].API[k].name;
                        }
                    }
                    strAPI = "Main API(s) used in this sample: " + strAPI;
                }
                $("#spnDemoAPIName").html(strAPI);

            }
        }
    }

    $("." + currentDemo + "").show();
});

$("#viewSource").live("click", function () {
    $("#demoSource").toggle();

    var o = $(this).children();
    if (o.hasClass('fa-angle-up')) {
        o.removeClass('fa-angle-up');
        o.addClass('fa-angle-down');
    } else {
        o.removeClass('fa-angle-down');
        o.addClass('fa-angle-up');
    }
});
