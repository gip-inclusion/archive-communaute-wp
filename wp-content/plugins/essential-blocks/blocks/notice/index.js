(()=>{"use strict";var e={d:(t,n)=>{for(var o in n)e.o(n,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:n[o]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}};((e,t,n)=>{var o={};n.r(o),n.d(o,{typoPrefix_text:()=>r,typoPrefix_title:()=>a});const a="title",r="text",l="margin",s="padding",i="wrp_",c="wrp_";var b=Object.defineProperty,p=Object.getOwnPropertySymbols,d=Object.prototype.hasOwnProperty,m=Object.prototype.propertyIsEnumerable,y=(e,t,n)=>t in e?b(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,f=(e,t)=>{for(var n in t||(t={}))d.call(t,n)&&y(e,n,t[n]);if(p)for(var n of p(t))m.call(t,n)&&y(e,n,t[n]);return e};const{generateDimensionsAttributes:C,generateTypographyAttributes:u,generateBackgroundAttributes:g,generateBorderShadowAttributes:k}=eb_controls,w=f(f(f(f(f({resOption:{type:"string",default:"Desktop"},blockId:{type:"string"},blockRoot:{type:"string",default:"essential_block"},blockMeta:{type:"object"},dismissible:{type:"boolean",default:!1},noticeType:{type:"string",default:"default"},titleFontSize:{type:"number"},textFontSize:{type:"number"},title:{type:"string",source:"text",selector:".eb-notice-title",default:"Save 20%"},text:{type:"string",source:"text",selector:".eb-notice-text",default:"Free shipping on all orders"},backgroundColor:{type:"string"},titleColor:{type:"string"},textColor:{type:"string"},noticeId:{type:"string"},showAfterDismiss:{type:"boolean",default:!1}},u(Object.values(o))),C(l)),C(s,{top:65,bottom:65,right:60,left:60,isLinked:!1})),k(c,{})),g(i,{defaultFillColor:"#3074ff",defaultBgGradient:"linear-gradient(45deg,#7967ff,#c277f2)"})),{__:v}=wp.i18n,h=[{label:v("Default","essential-blocks"),value:"default"},{label:v("Success","essential-blocks"),value:"success"},{label:v("Info","essential-blocks"),value:"info"},{label:v("Warning","essential-blocks"),value:"warning"},{label:v("Danger","essential-blocks"),value:"danger"}],{__:$}=(v("None","essential-blocks"),v("Lowercase","essential-blocks"),v("Capitalize","essential-blocks"),v("Uppercase","essential-blocks"),v("Lighter","essential-blocks"),v("Normal","essential-blocks"),v("Bold","essential-blocks"),v("Bolder","essential-blocks"),v("Initial","essential-blocks"),v("Overline","essential-blocks"),v("Line Through","essential-blocks"),v("Underline","essential-blocks"),v("Underline Oveline","essential-blocks"),wp.i18n),{InspectorControls:R}=wp.blockEditor,{PanelBody:S,ToggleControl:E,SelectControl:O,TabPanel:x}=wp.components,{useEffect:L}=wp.element,{select:P}=wp.data,{mimmikCssForResBtns:T,mimmikCssOnPreviewBtnClickWhileBlockSelected:M,ResponsiveDimensionsControl:N,TypographyDropdown:j,BorderShadowControl:B,ColorControl:D,BackgroundControl:_}=eb_controls,F=function(e){const{attributes:t,setAttributes:n}=e,{resOption:o,dismissible:b,noticeType:p,titleColor:d,textColor:m,showAfterDismiss:y}=t;L((()=>{n({resOption:P("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),L((()=>{T({domObj:document,resOption:o})}),[o]),L((()=>{const e=M({domObj:document,select:P,setAttributes:n});return()=>{e()}}),[]);const f={setAttributes:n,resOption:o,attributes:t,objAttributes:w};return React.createElement(R,{key:"controls"},React.createElement("div",{className:"eb-panel-control"},React.createElement(x,{className:"eb-parent-tab-panel",activeClass:"active-tab",tabs:[{name:"general",title:"General",className:"eb-tab general"},{name:"styles",title:"Style",className:"eb-tab styles"},{name:"advance",title:"Advanced",className:"eb-tab advance"}]},(e=>React.createElement("div",{className:"eb-tab-controls"+e.name},"general"===e.name&&React.createElement(React.Fragment,null,React.createElement(S,{title:$("Notice Settings","essential-blocks")},React.createElement(E,{label:$("Dismissible","essential-blocks"),checked:b,onChange:()=>n({dismissible:!b})}),React.createElement(E,{label:$("Show After Dismiss","essential-blocks"),checked:y,onChange:()=>n({showAfterDismiss:!y})}),React.createElement(O,{label:$("Type","essential-blocks"),value:p,options:h,onChange:e=>(e=>{switch(e){case"success":n({noticeType:e,wrp_backgroundColor:"#4caf50",titleColor:"#ffffff",textColor:"#ffffff"});break;case"info":n({noticeType:e,wrp_backgroundColor:"#d3d3d3",titleColor:"#000000",textColor:"#000000"});break;case"danger":n({noticeType:e,wrp_backgroundColor:"#f44336",titleColor:"#ffffff",textColor:"#ffffff"});break;case"warning":n({noticeType:e,wrp_backgroundColor:"#ffeb3b",titleColor:"#000000",textColor:"#000000"});break;case"default":n({noticeType:e,wrp_backgroundColor:"#2196f3",titleColor:"#ffffff",textColor:"#ffffff"})}})(e)}))),"styles"===e.name&&React.createElement(React.Fragment,null,React.createElement(S,{title:$("Title","essential-blocks")},React.createElement(j,{baseLabel:"Typography",typographyPrefixConstant:a,resRequiredProps:f}),React.createElement(D,{label:$("Color","essential-blocks"),color:d,onChange:e=>n({titleColor:e})})),React.createElement(S,{title:$("text","essential-blocks")},React.createElement(j,{baseLabel:"Typography",typographyPrefixConstant:r,resRequiredProps:f}),React.createElement(D,{label:$("Color","essential-blocks"),color:m,onChange:e=>n({textColor:e})}))),"advance"===e.name&&React.createElement(React.Fragment,null,React.createElement(S,{title:$("Margin & Padding")},React.createElement(N,{resRequiredProps:f,controlName:l,baseLabel:"Margin"}),React.createElement(N,{resRequiredProps:f,controlName:s,baseLabel:"Padding"})),React.createElement(S,{title:$("Background","essential-blocks"),initialOpen:!1},React.createElement(_,{controlName:i,resRequiredProps:f})),React.createElement(S,{title:$("Border & Shadow"),initialOpen:!1},React.createElement(B,{controlName:c,resRequiredProps:f}))))))))};var Z=Object.defineProperty,A=Object.getOwnPropertySymbols,I=Object.prototype.hasOwnProperty,G=Object.prototype.propertyIsEnumerable,q=(e,t,n)=>t in e?Z(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,z=(e,t)=>{for(var n in t||(t={}))I.call(t,n)&&q(e,n,t[n]);if(A)for(var n of A(t))G.call(t,n)&&q(e,n,t[n]);return e};const{useBlockProps:H,RichText:J}=wp.blockEditor,{useEffect:U}=wp.element,{select:V}=wp.data,{softMinifyCssStrings:W,generateTypographyStyles:K,generateDimensionsControlStyles:X,generateBackgroundControlStyles:Q,generateBorderShadowStyles:Y,mimmikCssForPreviewBtnClick:ee,duplicateBlockIdFix:te}=eb_controls;var ne=Object.defineProperty,oe=Object.getOwnPropertySymbols,ae=Object.prototype.hasOwnProperty,re=Object.prototype.propertyIsEnumerable,le=(e,t,n)=>t in e?ne(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n;const{RichText:se,useBlockProps:ie}=wp.blockEditor,ce=JSON.parse('{"title":"Notice","name":"essential-blocks/notice","category":"essential-blocks","description":"Put spotlight on news, announcements & let the visitors find it easily","apiVersion":2,"textdomain":"essential-blocks","supports":{"align":["wide","full"]}}');var be=Object.defineProperty,pe=Object.getOwnPropertySymbols,de=Object.prototype.hasOwnProperty,me=Object.prototype.propertyIsEnumerable,ye=(e,t,n)=>t in e?be(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n;const{__:fe}=wp.i18n,{registerBlockType:Ce}=wp.blocks,{name:ue}=ce;Ce(((e,t)=>{for(var n in t||(t={}))de.call(t,n)&&ye(e,n,t[n]);if(pe)for(var n of pe(t))me.call(t,n)&&ye(e,n,t[n]);return e})({name:ue},ce),{apiVersion:2,icon:()=>React.createElement("svg",{width:"256",height:"359",viewBox:"0 0 256 359",xmlns:"http://www.w3.org/2000/svg"},React.createElement("defs",null,React.createElement("linearGradient",{x1:"50%",y1:"-.962%",x2:"50%",y2:"102.035%",id:"linearGradient-1"},React.createElement("stop",{stopColor:"#1A6DFF",offset:"0%"}),React.createElement("stop",{stopColor:"#C822FF",offset:"100%"}))),React.createElement("g",{id:"Page-1",fill:"none",fillRule:"evenodd"},React.createElement("g",{id:"eb-notice",fill:"url(#linearGradient-1)",fillRule:"nonzero"},React.createElement("path",{d:"M128,0 C111.09568,0 97.28,13.815678 97.28,30.72 L97.28,40.96 L15.36,40.96 C6.9377536,40.96 0,47.8977536 0,56.32 L0,343.04 C0,351.462246 6.9377536,358.4 15.36,358.4 L240.64,358.4 C249.062246,358.4 256,351.462246 256,343.04 L256,56.32 C256,47.8977536 249.062246,40.96 240.64,40.96 L158.72,40.96 L158.72,30.72 C158.72,13.815678 144.90432,0 128,0 Z M128,10.24 C139.36832,10.24 148.48,19.351682 148.48,30.72 L148.48,66.56 C148.48,69.4529536 146.252954,71.68 143.36,71.68 L112.64,71.68 C109.747046,71.68 107.52,69.4529536 107.52,66.56 L107.52,30.72 C107.52,19.351682 116.63168,10.24 128,10.24 Z M128,25.6 C125.172302,25.6 122.88,27.8923021 122.88,30.72 C122.88,33.5476979 125.172302,35.84 128,35.84 C130.827698,35.84 133.12,33.5476979 133.12,30.72 C133.12,27.8923021 130.827698,25.6 128,25.6 Z M15.36,51.2 L97.28,51.2 L97.28,61.44 L92.16,61.44 C80.9096499,61.44 71.68,70.6696499 71.68,81.92 L71.68,87.04 L72.72,87.04 C75.0565325,95.7765786 82.7207987,102.4 92.16,102.4 L163.84,102.4 C173.279201,102.4 180.943468,95.7765786 183.28,87.04 L184.32,87.04 L184.32,81.92 C184.32,70.6696499 175.09035,61.44 163.84,61.44 L158.72,61.44 L158.72,51.2 L240.64,51.2 C243.532954,51.2 245.76,53.4270464 245.76,56.32 L245.76,343.04 C245.76,345.932954 243.532954,348.16 240.64,348.16 L15.36,348.16 C12.4670464,348.16 10.24,345.932954 10.24,343.04 L10.24,56.32 C10.24,53.4270464 12.4670464,51.2 15.36,51.2 Z M35.84,71.68 C33.0123021,71.68 30.72,73.9723021 30.72,76.8 C30.72,79.6276979 33.0123021,81.92 35.84,81.92 C38.6676979,81.92 40.96,79.6276979 40.96,76.8 C40.96,73.9723021 38.6676979,71.68 35.84,71.68 Z M92.16,71.68 L98.24,71.68 C100.376924,77.6054835 106.01919,81.92 112.64,81.92 L143.36,81.92 C149.98081,81.92 155.623076,77.6054835 157.76,71.68 L163.84,71.68 C169.55733,71.68 174.08,76.2026701 174.08,81.92 C174.08,87.6373299 169.55733,92.16 163.84,92.16 L92.16,92.16 C86.4426701,92.16 81.92,87.6373299 81.92,81.92 C81.92,76.2026701 86.4426701,71.68 92.16,71.68 Z M35.84,92.16 C33.0123021,92.16 30.72,94.4523021 30.72,97.28 C30.72,100.107698 33.0123021,102.4 35.84,102.4 C38.6676979,102.4 40.96,100.107698 40.96,97.28 C40.96,94.4523021 38.6676979,92.16 35.84,92.16 Z M35.84,112.64 C33.0123021,112.64 30.72,114.932302 30.72,117.76 C30.72,120.587698 33.0123021,122.88 35.84,122.88 C38.6676979,122.88 40.96,120.587698 40.96,117.76 C40.96,114.932302 38.6676979,112.64 35.84,112.64 Z M35.84,133.12 C33.0123021,133.12 30.72,135.412302 30.72,138.24 C30.72,141.067698 33.0123021,143.36 35.84,143.36 C38.6676979,143.36 40.96,141.067698 40.96,138.24 C40.96,135.412302 38.6676979,133.12 35.84,133.12 Z M35.84,153.6 C33.0123021,153.6 30.72,155.892302 30.72,158.72 C30.72,161.547698 33.0123021,163.84 35.84,163.84 C38.6676979,163.84 40.96,161.547698 40.96,158.72 C40.96,155.892302 38.6676979,153.6 35.84,153.6 Z M117.76,153.6 L121.180001,242.349998 L134.819999,242.349998 L138.24,153.6 L117.76,153.6 Z M35.84,174.08 C33.0123021,174.08 30.72,176.372302 30.72,179.2 C30.72,182.027698 33.0123021,184.32 35.84,184.32 C38.6676979,184.32 40.96,182.027698 40.96,179.2 C40.96,176.372302 38.6676979,174.08 35.84,174.08 Z M35.84,194.56 C33.0123021,194.56 30.72,196.852302 30.72,199.68 C30.72,202.507698 33.0123021,204.8 35.84,204.8 C38.6676979,204.8 40.96,202.507698 40.96,199.68 C40.96,196.852302 38.6676979,194.56 35.84,194.56 Z M35.84,215.04 C33.0123021,215.04 30.72,217.332302 30.72,220.16 C30.72,222.987698 33.0123021,225.28 35.84,225.28 C38.6676979,225.28 40.96,222.987698 40.96,220.16 C40.96,217.332302 38.6676979,215.04 35.84,215.04 Z M35.84,235.52 C33.0123021,235.52 30.72,237.812302 30.72,240.64 C30.72,243.467698 33.0123021,245.76 35.84,245.76 C38.6676979,245.76 40.96,243.467698 40.96,240.64 C40.96,237.812302 38.6676979,235.52 35.84,235.52 Z M35.84,256 C33.0123021,256 30.72,258.292302 30.72,261.12 C30.72,263.947698 33.0123021,266.24 35.84,266.24 C38.6676979,266.24 40.96,263.947698 40.96,261.12 C40.96,258.292302 38.6676979,256 35.84,256 Z M128,256.860001 C122.344604,256.860001 117.76,261.444605 117.76,267.100001 C117.76,272.755397 122.344604,277.340001 128,277.340001 C133.655396,277.340001 138.24,272.755397 138.24,267.100001 C138.24,261.444605 133.655396,256.860001 128,256.860001 Z M35.84,276.48 C33.0123021,276.48 30.72,278.772302 30.72,281.6 C30.72,284.427698 33.0123021,286.72 35.84,286.72 C38.6676979,286.72 40.96,284.427698 40.96,281.6 C40.96,278.772302 38.6676979,276.48 35.84,276.48 Z M35.84,296.96 C33.0123021,296.96 30.72,299.252302 30.72,302.08 C30.72,304.907698 33.0123021,307.2 35.84,307.2 C38.6676979,307.2 40.96,304.907698 40.96,302.08 C40.96,299.252302 38.6676979,296.96 35.84,296.96 Z M35.84,317.44 C33.0123021,317.44 30.72,319.732302 30.72,322.56 C30.72,325.387698 33.0123021,327.68 35.84,327.68 C38.6676979,327.68 40.96,325.387698 40.96,322.56 C40.96,319.732302 38.6676979,317.44 35.84,317.44 Z",id:"Shape"})))),attributes:w,keywords:[fe("EB notice","essential-blocks"),fe("notice","essential-blocks"),fe("alert ","essential-blocks")],edit:function(e){const{attributes:t,setAttributes:n,clientId:o,isSelected:b}=e,{blockId:p,blockMeta:d,resOption:m,dismissible:y,title:f,text:C,titleColor:u,textColor:g}=t;U((()=>{n({resOption:V("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),U((()=>{te({BLOCK_PREFIX:"eb-notice",blockId:p,setAttributes:n,select:V,clientId:o})}),[]),U((()=>{ee({domObj:document,select:V})}),[]);const k=H({className:"eb-guten-block-main-parent-wrapper"}),{typoStylesDesktop:w,typoStylesTab:v,typoStylesMobile:h}=K({attributes:t,prefixConstant:a,defaultFontSize:32}),{typoStylesDesktop:$,typoStylesTab:R,typoStylesMobile:S}=K({attributes:t,prefixConstant:r,defaultFontSize:18}),{dimensionStylesDesktop:E,dimensionStylesTab:O,dimensionStylesMobile:x}=X({controlName:l,styleFor:"margin",attributes:t}),{dimensionStylesDesktop:L,dimensionStylesTab:P,dimensionStylesMobile:T}=X({controlName:s,styleFor:"padding",attributes:t}),{backgroundStylesDesktop:M,hoverBackgroundStylesDesktop:N,backgroundStylesTab:j,hoverBackgroundStylesTab:B,backgroundStylesMobile:D,hoverBackgroundStylesMobile:_,overlayStylesDesktop:Z,hoverOverlayStylesDesktop:A,overlayStylesTab:I,hoverOverlayStylesTab:G,overlayStylesMobile:q,hoverOverlayStylesMobile:ne,bgTransitionStyle:oe,ovlTransitionStyle:ae}=Q({attributes:t,controlName:i}),{styesDesktop:re,styesTab:le,styesMobile:se,stylesHoverDesktop:ie,stylesHoverTab:ce,stylesHoverMobile:be,transitionStyle:pe}=Y({controlName:c,attributes:t}),de=`\n\t.eb-notice-wrapper.${p}{\n\t\t${O}\n\t\t${P}\n\t\t${j}\n\t\t${le}\t\t\n\t}\n\n\t.eb-notice-wrapper.${p}:hover{\n\t\t${B}\n\t\t${ce}\n\t}\n\n\t.eb-notice-wrapper.${p}:before{\n\t\t${I}\n\t}\n\n\t.eb-notice-wrapper.${p}:hover:before{\n\t\t${G}\n\t}\n\n\t`,me=`\n\t.eb-notice-wrapper.${p}{\n\t\t${x}\n\t\t${T}\n\t\t${D}\n\t\t${se}\n\t}\n\n\t.eb-notice-wrapper.${p}:hover{\n\t\t${_}\n\t\t${be}\n\t}\n\n\t.eb-notice-wrapper.${p}:before{\n\t\t${q}\n\t}\n\n\t.eb-notice-wrapper.${p}:hover:before{\n\t\t${ne}\n\t}\n\t`,ye=`\n\t.eb-notice-wrapper.${p} .eb-notice-title{\n\t\t${v}\n\t}\n\t`,fe=`\n\t.eb-notice-wrapper.${p} .eb-notice-title{\n\t\t${h}\n\t}\n\t`,Ce=`\n\t.eb-notice-wrapper.${p} .eb-notice-text{\n\t\t${R}\n\t}\n\t`,ue=`\n\t.eb-notice-wrapper.${p} .eb-notice-text{\n\t\t${S}\n\t}\n\t`,ge=W(`\n\t\t\n\n\t.eb-notice-wrapper.${p} > * {\n\t\tposition: relative;\n\t}\t\n\n\t.eb-notice-wrapper.${p}{\n\t\t${E}\n\t\t${L}\n\t\t${M}\n\t\t${re}\n\t\ttransition:${oe}, ${pe};\n\t\toverflow: hidden;\n\t\tposition: relative;\n\t\t\n\t}\n\t\n\t.eb-notice-wrapper.${p}:hover{\n\t\t${N}\n\t\t${ie}\n\t}\n\t\n\t.eb-notice-wrapper.${p}:before{\n\t\t${Z}\n\t\ttransition:${ae};\n\t}\n\n\t.eb-notice-wrapper.${p}:hover:before{\n\t\t${A}\n\t}\n\n\t\n\t\t\n\t.eb-notice-wrapper.${p} .eb-notice-title-wrapper{\n\t\tdisplay: flex;\n\t\tjustify-content: space-between;\n\t}\t\n\t\n\t\t\n\t.eb-notice-wrapper.${p} .eb-notice-dismiss{\n\t\tcolor: ${g||"#edf1f7"};\n\t\tdisplay: ${y?"flex":"none"};\n\n\t\ttop: 0px;\n\t\tright: 0px;\n\t\twidth: 24px;\n\t\theight: 24px;\n\t\tposition: absolute;\n\t\tjustify-content: center;\n\t}\n\n\t.eb-notice-wrapper.${p} .eb-notice-dismiss:after{\n\t\tcontent: "\\00d7";\n\t}\n\n\t.entry-content\n\t> *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce) {\n\t\tmargin-left: auto;\n\t\tmargin-right: auto;\n\t}\n\n\t\n\t\t\n\t.eb-notice-wrapper.${p} .eb-notice-title{\n\t\t${w}\t\t\n\t\tcolor: ${u||"#fff"};\n\t}\n\t\n\t\t\n\t.eb-notice-wrapper.${p} .eb-notice-text{\n\t\t${$}\n\t\tcolor: ${g||"#edf1f7"};\n\t}\n\t\n\t`),ke=W(`\n\t\t${de}\n\t\t${ye}\n\t\t${Ce}\n\t`),we=W(`\n\t\t${me}\n\t\t${fe}\n\t\t${ue}\n\t`);return U((()=>{const e={desktop:ge,tab:ke,mobile:we};JSON.stringify(d)!=JSON.stringify(e)&&n({blockMeta:e})}),[t]),[b&&React.createElement(F,z({},e)),React.createElement("div",z({},k),React.createElement("style",null,`\n\t\t\t\t${ge}\n\n\t\t\t\t/* mimmikcssStart */\n\n\t\t\t\t${"Tablet"===m?ke:" "}\n\t\t\t\t${"Mobile"===m?ke+we:" "}\n\n\t\t\t\t/* mimmikcssEnd */\n\n\t\t\t\t@media all and (max-width: 1024px) {\t\n\n\t\t\t\t\t/* tabcssStart */\t\t\t\n\t\t\t\t\t${W(ke)}\n\t\t\t\t\t/* tabcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t\n\t\t\t\t@media all and (max-width: 767px) {\n\t\t\t\t\t\n\t\t\t\t\t/* mobcssStart */\t\t\t\n\t\t\t\t\t${W(we)}\n\t\t\t\t\t/* mobcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t`),React.createElement("div",{className:`eb-notice-wrapper ${p}`,"data-id":p},React.createElement("div",{className:"eb-notice-title-wrapper"},React.createElement(J,{className:"eb-notice-title",value:f,onChange:e=>n({title:e}),placeholder:"Add Title...",keepPlaceholderOnFocus:!0})),React.createElement("span",{className:"eb-notice-dismiss"}),React.createElement("div",null,React.createElement(J,{className:"eb-notice-text",value:C,onChange:e=>n({text:e}),placeholder:"Add Text...",keepPlaceholderOnFocus:!0}))))]},save:({attributes:e})=>{const{blockId:t,showAfterDismiss:n,title:o,text:a}=e;return React.createElement("div",((e,t)=>{for(var n in t||(t={}))ae.call(t,n)&&le(e,n,t[n]);if(oe)for(var n of oe(t))re.call(t,n)&&le(e,n,t[n]);return e})({},ie.save()),React.createElement("div",{className:`eb-notice-wrapper ${t}`,"data-id":t,"data-show-again":n},React.createElement("div",{className:"eb-notice-title-wrapper"},React.createElement(se.Content,{tagName:"div",className:"eb-notice-title",value:o})),React.createElement("span",{className:"eb-notice-dismiss",style:{cursor:"pointer"}}),React.createElement("div",null,React.createElement(se.Content,{tagName:"div",className:"eb-notice-text",value:a}))))},example:{attributes:{noticeType:"default"}}})})(0,0,e)})();