wp.blocks.registerBlockType('ourplugin/are-you-paying-attention',{
    title: 'Are you Payung Attention?',
    icon: 'smiley',
    category: 'common',
    edit: function() {
        //Vista del admin
        return (
            <div><p>Hello, this is a paragraph</p>
                <h3>This is a H3 from JSX.</h3>
            </div>
        ) 
    },
    save: function () {
        //Vista del cliente
        return (
            <>
                <h3>This is heading 3</h3>
                <h5>This is heading 5</h5>
            </>
            
        )
    }
});