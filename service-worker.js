if(!self.define){const e=async e=>{if("require"!==e&&(e+=".js"),!r[e]&&(await new Promise(async i=>{if("document"in self){const r=document.createElement("script");r.src=e,document.head.appendChild(r),r.onload=i}else importScripts(e),i()}),!r[e]))throw new Error(`Module ${e} didn’t register its module`);return r[e]},i=async(i,r)=>{const c=await Promise.all(i.map(e));r(1===c.length?c[0]:c)};i.toUrl=e=>`./${e}`;const r={require:Promise.resolve(i)};self.define=(i,c,o)=>{r[i]||(r[i]=new Promise(async r=>{let s={};const f={uri:location.origin+i.slice(1)},n=await Promise.all(c.map(i=>"exports"===i?s:"module"===i?f:e(i))),a=o(...n);s.default||(s.default=a),r(s)}))}}define("./service-worker.js",["./workbox-43b6daaf"],(function(e){"use strict";self.addEventListener("message",e=>{e.data&&"SKIP_WAITING"===e.data.type&&self.skipWaiting()}),e.precacheAndRoute([{url:"404.html",revision:"c9dc4467808ec859bf7a846d886cffd5"},{url:"browserconfig.xml",revision:"f6cb7eceb4b088672ff80964d878ccad"},{url:"clubs.html",revision:"0822f21f544020aae22aca1c1e55605f"},{url:"css.css",revision:"2a9b001cf04370d9a52ef4fc6423607a"},{url:"evolocity.html",revision:"7c49f307b955fe7ce0cfe0a7db5704c4"},{url:"google1ce369827c931c5b.html",revision:"5a6edcc0985be2993fedb568e8c435fe"},{url:"img/android-chrome-192x192.png",revision:"588ffbcf644e29c1a1ea38a20a89f519"},{url:"img/android-chrome-512x512.png",revision:"d44cc477c19fe99280010735eda66b6a"},{url:"img/apple-touch-icon.png",revision:"ffb54c178723fe071726e5a884b3bcef"},{url:"img/evolocity.png",revision:"1e18af1f408805497ef45533689f25d6"},{url:"img/favicon-16x16.png",revision:"8e7f45a80eeb52e847fd71205e92e360"},{url:"img/favicon.ico",revision:"6f4c928202529be2d9fd341358f0b6bb"},{url:"img/favicon.png",revision:"0cff3693d19344342062a4162c276467"},{url:"img/mstile-150x150.png",revision:"85562b286fb13d2b618160925032bdbe"},{url:"img/placeholder.png",revision:"83cd44f1190394b57de798f5c9bd7931"},{url:"img/robot.webp",revision:"690813fe3639ce1a009298748e9c6f7b"},{url:"img/robotsq.png",revision:"50a1a18d301622d523131ad3936d23df"},{url:"index.html",revision:"005d26c9ed6f823a0bbd7d7c40007226"},{url:"js/script.js",revision:"4e93b805e81096c6aaf48ffe901141a3"},{url:"js/workbox-window.prod.mjs",revision:"4ac30e931e98095a1cf1e9f6e008c6ce"},{url:"README.md",revision:"755c973a45c4542764e6910851265f8b"},{url:"robotics.html",revision:"bf6139fe797fd37e0a8fbc05a531c0d8"},{url:"settings.html",revision:"b781d9126c642dab25b1e81a657b9102"},{url:"signup.html",revision:"c64ebba663a8a3618200240fc7fbe39f"},{url:"site.webmanifest",revision:"c0a9a26f804a9e442d8f28b3858565d0"}],{})}));
//# sourceMappingURL=service-worker.js.map
