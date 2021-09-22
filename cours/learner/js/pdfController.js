// Recuperation du fichier a lire

function currentFile(){
   let fileName =  $("#file-name").val();
    const url = "../assets/fichier_cours/"+fileName +""
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    var progressBar = document.querySelector("#progressBar")
    var init = document.querySelector("#init")
    var total = document.querySelector("#total")
    var numPages = 0

    let pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null;
    
        const scale  = 2;
        console.log(scale)
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
            document.querySelector('#init').textContent =' '+ num;
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

    ///whe the reading oage is changed
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

    document.querySelector("#suiv").addEventListener('click',next);
    document.querySelector("#prece").addEventListener('click', prev);


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

     // container principal
     let mainFrame = document.querySelector(".mainFrame");
     // mainFrame.style.width="100%";

     // alert("Height= "+deviceHeight+" width= "+deviceWidth);
     document.body.style.backgroundColor="#6c757d";

     // ecran tres large
     function myFunction(x) {
         if (x.matches) { // If media query matches
             courseInfoFrame.style.width="30%";
             courseInfoFrame.style.height=deviceHeight+"px";
             courseInfoFrame.style.position="fixed";

             canvasDim.style.width = "800px";
             canvasDim.style.height = deviceHeight+"px";


             coursCanvasFrame.style.width="80%";
             coursCanvasFrame.style.marginLeft="400px"
             coursCanvasFrame.style.height="1050px";

         } else {
                // ecran mobile
             function mediumFunction(x1) {
                 if (x1.matches) { 
                      courseInfoFrame.style.display="none";
                     
                                 // courseInfoFrame.style.position="fixed";
                                 // courseInfoFrame.style.height=deviceHeight+"px";
                                 // currentCourseCard.classList.remove('col-4');
                                 // currentCourseCard.classList.add('col-5');
                                 // currentCourseCard.style.backgroundColor = "yellow";
                                 
                                 canvasDim.style.width = "400px";
                                 canvasDim.style.height = (deviceHeight-100)+"px";

                                 coursCanvasFrame.style.width="200px";
                                 coursCanvasFrame.style.marginLeft="30%"
                                 coursCanvasFrame.style.height="800px";
                                 $(".coursCanvas").css('justify-content','center')

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

         var x = window.matchMedia("(min-width: 1499px)")
         myFunction(x) // Call listener function at run time
         x.addListener(myFunction) // Attach listener function on state changes


}