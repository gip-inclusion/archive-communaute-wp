!function(){"use strict";var e=window.wp.blocks,l=EssentialBlocksLocalize.enabled_blocks;Object.values(l).filter((function(e){return"false"==e.visibility})).forEach((function(l){var c="essential-blocks/".concat(l.value.replace(/_/g,"-"));console.log("blockName:",c),((0,e.getBlockType)(c)||"undefined"!=(0,e.getBlockType)(c))&&(0,e.unregisterBlockType)(c)}))}();