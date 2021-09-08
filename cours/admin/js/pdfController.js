const url = "./pdf/mamunur.pdf"
var pdfjsLib = window['pdfjs-dist/build/pdf'];



let pdfDoc = null,
    pageNum = 1,
    pageIsRendering = false,
    pageNumIsPending = null;

const scale  = 1.5,
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
    if(pageNum<=1){
        return;
    }
    pageNum--;
    renderPage(pageNum);
}
// show previous page
const next = ()=>{
    if(pageNum>=pdfDoc.pageNum){
        return;
    }
    pageNum++;
    renderPage(pageNum);
}

// Get document

pdfjsLib.getDocument(url).promise.then(pdfDoc_ =>{
pdfDoc = pdfDoc_;
renderPage(pageNum);
});

document.querySelector("#suiv").addEventListener('click',next);
document.querySelector("#prece").addEventListener('click', prev);