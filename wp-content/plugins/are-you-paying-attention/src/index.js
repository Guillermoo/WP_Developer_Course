import "./index.scss"
import {TextControl, Flex, FlexBlock,FlexItem,Button,Icon} from "@wordpress/components"

wp.blocks.registerBlockType('ourplugin/are-you-paying-attention',{
    title: 'Are you Payung Attention?',
    icon: 'smiley',
    category: 'common',
    attributes: {
        skyColor:{type: "string"},
        grassColor:{type: "string"}
    },
    edit: EditComponents,
    save: function (props) {
        //Vista del cliente
        return null
    }
});

function EditComponents(props) {
    //Vista del admin
    
    function updateSkyColor(event){
        props.setAttributes({skyColor: event.target.value})
    }
    function updateGrassColor(event){
        props.setAttributes({grassColor: event.target.value})
    }
    
    return (
        <div className="paying-attention-edit-block">
            <TextControl label="Question:"/>
            {/* Se puede usar html normal, pero mejor usar los componentes de wordpress */}
            {/* <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor}/> */}
            {/* <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor}/> */}
            <p>Answers:</p>
            <Flex>
                <FlexBlock>
                    <TextControl />
                </FlexBlock>
                <FlexItem>
                    <Button>
                        <Icon icon="star-empty" />
                    </Button>
                </FlexItem>
                <FlexItem>
                    <Button>Delete</Button>
                </FlexItem>
            </Flex>
        </div>
    ) 
}