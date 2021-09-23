// Recuperation du fichier a lire

function currentFile(){
   let fileName =  $("#file-name").val();
    const url = "../assets/fichier_cours/"+fileName +""
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    var progressBar = document.querySelector(".progressBar");
    var init = document.querySelector(".init");
    var total = document.querySelector(".total");
    var numPages = 0

    let pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null;
    
        const scale  = 2;
        canvas = document.querySelector('#pdf-render'),
        ctx = canvas.getContext('2d');


    // render the page
    const renderPage = num =>{
        pageIsRendering =true;
        pdfDoc.getPage(num).then(page =>{
            const viewport = page.getViewport({scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderCtx = {
                canvasContext:ctx,
                viewport
            }
            page.render(renderCtx).promise.then(() => {
                pageIsRendering = false;
                if(pageNumIsPending !==null){
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });
            document.querySelector('.init').textContent =' '+ num;
        });
    }

    // check for page rendering
    const queue = num =>{
        if(pageIsRendering){
            pageNumIsPending = num;
        }else{
            renderPage(num);
        }
    }

    // show next page
    const prev = ()=>{
        if(pageNum>1){
            pageNum--;
            renderPage(pageNum);
            setPercentage(pageNum);
        }
    }
    // show previous page
    const next = ()=>{
        
        if(pageNum<numPages)
        {
            pageNum++;
            renderPage(pageNum);
            setPercentage(pageNum);
        }
    }

    //changes the percentage of the progression
    const setPercentage = (pageNum)=>
    {
        var percentage = (pageNum) * 100 / numPages
        progressBar.innerHTML = Math.round(percentage)
        progressBar.style.width = percentage+'%'
        init.innerHTML = pageNum
        total.innerHTML = numPages
        /////////////////////////////

    }

    // Get document
    pdfjsLib.getDocument(url).promise.then(pdfDoc_ =>{
    pdfDoc = pdfDoc_;
    numPages = pdfDoc.numPages
    setPercentage(pageNum);
    renderPage(pageNum);
    });

    // ///whe the reading oage is changed
    $('#form_reader').submit(
        (e)=>
        {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: './js/ajax_data.php',
                data: 'page='+pageNum+'&matricule='+matricule+"&idCourse="+idCourse+'&idSub='+idSub,
                success: function(response)
                {
                    console.log(response)
                }
            })
        }
    )

    document.querySelector(".suiv").addEventListener('click',next);
    document.querySelector(".prece").addEventListener('click', prev);


    ////////////////////////////////////////////////////////////////////////////////////////////////////////

     // Recuperation des duimension de l'ecran du visiteur
     let deviceScrenne = window.screen;
     let deviceHeight = deviceScrenne.availHeight;
     let deviceWidth = deviceScrenne.availWidth;
     // recuperation des dimensions du canvas
     let canvasDim = document.getElementById("pdf-render");
     let canWidth = canvasDim.offsetWidth;
     let canHeight = canvasDim.offsetHeight;
     //course infos
     let courseInfoFrame = document.querySelector(".courseDetail");
     let coursCanvasFrame = document.querySelector(".coursCanvas");
     let otherCoursFrame = document.querySelector(".otherCours");
     // current cours card 
     let currentCourseCard = document.querySelector("#currentCourse");

     // containers principaux
     let mainFrame = document.querySelector(".mainFrame");
     let mainFrame1 = document.querySelector(".mainFrame1");
     
     // mainFrame.style.width="100%";

     // alert("Height= "+deviceHeight+" width= "+deviceWidth);
     document.body.style.backgroundColor="#6c757d";

     



     // ecran tres large
     function myFunction(x) {
         if (x.matches) { // If media query matches
             courseInfoFrame.style.width="30%";
             courseInfoFrame.style.height=deviceHeight+"px";
             courseInfoFrame.style.position="fixed";
             mainFrame1.style.display="flex";
             canvasDim.style.width = "800px";
             canvasDim.style.height = deviceHeight+"px";


             coursCanvasFrame.style.width="80%";
             coursCanvasFrame.style.marginLeft="400px"
             coursCanvasFrame.style.height="1050px";
             document.getElementById("smallScreen").style.display="none";

         } else {
            //  mobile
            function petiFunction(x3) {
                if (x3.matches) { alert("600px")
                   //  On cache le side bar a gauche
                   courseInfoFrame.style.display="none";
                   // ON affiche la barre en bas 
                   // document.getElementById("smallScreen").style.display="flex";
                   document.getElementById("smallScreen").style.width=(deviceWidth)+"px";
                   document.getElementById("smallScreen").style.backgroundColor="transparent";
                   document.getElementById("actual").style.display="none";
                   // on modifie les carte pour adapter aux ecrans du mobile
                   document.getElementById("mobileCurrentCourse").classList.remove('col-4');
                   document.getElementById("mobileCurrentCourse").classList.add('col-7');
                   document.getElementById("mobileCurrentCourse").style.backgroundColor="red";
                   // alert("Height= "+deviceHeight+" width= "+deviceWidth);
                   // modification des proprietes du container principal
                   mainFrame.style.position="relative";
                   //   document.getElementById("margTop").classList.remove('mt-4');
        
                    // courseInfoFrame.style.position="fixed";
                    // courseInfoFrame.style.height=deviceHeight+"px";
                    // currentCourseCard.classList.remove('col-4');
                    // currentCourseCard.classList.add('col-5');
                    // currentCourseCard.style.backgroundColor = "yellow";
                    
                    canvasDim.style.width = (deviceWidth)+"px";
                    canvasDim.style.height = "800px";

                    coursCanvasFrame.style.width=(deviceWidth)+"px";
                    //  coursCanvasFrame.style.marginLeft="50px"
                    coursCanvasFrame.style.height=deviceHeight+"px";
                    $(".mobileScreen").css('display','flex');

                    //  alert("Height= "+deviceHeight+" width= "+deviceWidth)
                    
                } else { 
                           // ecran tablette
                 function mediumFunction(x1) {
                    if (x1.matches) { 
                        alert("900px");
                       //  On cache le side bar a gauche
                       courseInfoFrame.style.display="none";
                       courseInfoFrame.style.position="relative";
                       // ON affiche la barre en bas 
                       // document.getElementById("smallScreen").style.display="flex";
                       document.getElementById("smallScreen").style.width=deviceWidth+"px";
                    //    document.getElementById("smallScreen").style.margin="550px 0 0 0";
                       document.getElementById("smallScreen").style.position="relative";
                       // on modifie les carte pour adapter aux ecrans du mobile
                       document.getElementById("mobileCurrentCourse").classList.remove('col-4');
                       document.getElementById("mobileCurrentCourse").classList.add('col-7');
                       document.getElementById("mobileCurrentCourse").style.backgroundColor="red";
                       // alert("Height= "+deviceHeight+" width= "+deviceWidth);
                       // modification des proprietes du container principal
                       mainFrame.style.position="";
                       mainFrame1.style.display="block";
                       
                    
            
                       //   document.getElementById("margTop").classList.remove('mt-4');
                         
                                    // courseInfoFrame.style.position="fixed";
                                    // courseInfoFrame.style.height=deviceHeight+"px";
                                    // currentCourseCard.classList.remove('col-4');
                                    // currentCourseCard.classList.add('col-5');
                                    // currentCourseCard.style.backgroundColor = "yellow";
                                    
                                    canvasDim.style.width = deviceWidth+"px";
                                    canvasDim.style.height = "1000px";
    
                                    coursCanvasFrame.style.width=(deviceWidth)+"px";
                                    coursCanvasFrame.style.position="relative";
                                   //  coursCanvasFrame.style.marginLeft="50px"
                                    coursCanvasFrame.style.height=deviceHeight+"px";
                                    // $(".mobileScreen").css('display','flex')
    
                                   //  alert("Height= "+deviceHeight+" width= "+deviceWidth)
                        
                    } else {
                             // ecran medium 
                            function mobileFunction(x2) {
                                if (x2.matches) { 
                                   // If media query matches
                                    courseInfoFrame.style.position="fixed";
                                    courseInfoFrame.style.height=deviceHeight+"px";
                                    currentCourseCard.classList.remove('col-4');
                                    currentCourseCard.classList.add('col-5');
                                    currentCourseCard.style.backgroundColor = "yellow";
    
                                    canvasDim.style.width = "600px";
                                    canvasDim.style.height = deviceHeight+"px";
    
    
    
                                    coursCanvasFrame.style.width="800px";
                                    coursCanvasFrame.style.marginLeft="400px"
                                    coursCanvasFrame.style.height="800px";
                                } else {
                                    currentCourseCard.style.backgroundColor = "green";
                                }
                            }
                            var x2 = window.matchMedia("(max-width: 1499px)");
                            mobileFunction(x2);
                            x2.addListener(mobileFunction);
                        }
                    }
                    var x1 = window.matchMedia("(max-width: 900px)");
                    mediumFunction(x1);
                    x1.addListener(mediumFunction);
                    }
                }
                var x3 = window.matchMedia("(max-width: 600px)");
                petiFunction(x3);
                x3.addListener(petiFunction);
             }
         }
         var x = window.matchMedia("(min-width: 1499px)")
         myFunction(x) // Call listener function at run time
         x.addListener(myFunction) // Attach listener function on state changes



}