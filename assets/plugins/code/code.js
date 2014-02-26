if (typeof RedactorPlugins === 'undefined')
    var RedactorPlugins = {};
RedactorPlugins.code = {
    init: function()
    {
        this.buttonAddBefore('html', 'quote', 'Quote', $.proxy(this.toggleQuote, this));
        this.buttonAddBefore('html', 'pre', 'Code', $.proxy(this.toggleCode, this));
        this.buttonAddSeparatorBefore('html');
    },
    toggleQuote: function(key, obj) {
        this.formatQuote();
        if (this.getBlock() === false) {
            this.buttonInactive('quote');
        } else {
            this.buttonActive('quote');
        }
    },
    toggleCode: function(key, obj) {
        this.formatBlocks('pre');
        if (this.getBlock() === false) {
            this.buttonInactive('pre');
        } else {
            this.buttonActive('pre');
            this.blockSetClass('prettyprint linenums');
        }
    },
}