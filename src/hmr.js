/*********************** Hot Module Replacement // refine  ***********************/
if (module.hot) {
  module.hot.accept();
}	

//https://gist.github.com/christopher4lis/ce3d09c10732dca5c9e9d88862d122d8#file-hot-reload-extracted-stylesheets
if (module.hot) {
    const hotEmitter = require("webpack/hot/emitter");
    const DEAD_CSS_TIMEOUT = 2000;

    hotEmitter.on("webpackHotUpdate", function(currentHash) {
        document.querySelectorAll("link[href][rel=stylesheet]").forEach((link) => {
            const nextStyleHref = link.href.replace(/(\?\d+)?$/, `?${Date.now()}`);
            const newLink = link.cloneNode();
            newLink.href = nextStyleHref;

            link.parentNode.appendChild(newLink);
            setTimeout(() => {
                link.parentNode.removeChild(link);
            }, DEAD_CSS_TIMEOUT);
        });
    })
}

