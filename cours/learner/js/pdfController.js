const url = "./pdf/mamunur.pdf"
var pdfjsLib = window['pdfjs-dist/build/pdf'];
var progressBar = document.querySelector("#progressBar")
var init = document.querySelector("#init")
var total = document.querySelector("#total")
var numPages = 0


let pdfDoc = null,
    pageNum = 1,
    pageIsRendering = false,
    pageNumIsPending = null;

const scale  = 1,
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
    progressBar.innerHTML = percentage
    progressBar.style.width = percentage+'%'
    init.innerHTML = pageNum
    total.innerHTML = numPages
    console.log(progressBar);
}

// Get document
pdfjsLib.getDocument(url).promise.then(pdfDoc_ =>{
pdfDoc = pdfDoc_;
numPages = pdfDoc.numPages
setPercentage(pageNum);
renderPage(pageNum);
});

document.querySelector("#suiv").addEventListener('click',next);
document.querySelector("#prece").addEventListener('click', prev);
