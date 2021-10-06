import "./index.scss"
import {TextControl, Flex, FlexBlock,FlexItem,Button,Icon, PanelBody, PanelRow, ColorPicker} from "@wordpress/components"
import {InspectorControls, BlockControls,AlignmentToolbar} from "@wordpress/block-editor"
import {ChromePicker} from "react-color"


// Podemos crear esta función sin nombre. En el parentesis final se puede ejecutar lo que sea despues de eta función.
// Las variables viven sólo dentro de la función
// IIFE Inmendiatly invoke function expression
(function(){

    let locked = false

    wp.data.subscribe(function(){
        const results = wp.data.select("core/block-editor").getBlocks().filter(function(block){
            return block.name == "ourplugin/are-you-paying-attention" && block.attributes.correctAnswer == undefined
        })

        if (results.length && locked == false){
            locked = true
            wp.data.dispatch("core/editor").lockPostSaving("noanswer")
        }
        if (! results.length && locked){
            locked = false
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer")
        }
    })
})()


wp.blocks.registerBlockType('ourplugin/are-you-paying-attention',{
    title: 'Are you Payung Attention?',
    icon: 'smiley',
    category: 'common',
    attributes: {
        question:{type: "string"},
        answers: {type: "array", default:["red", "blue"]},
        correctAnswer: {type: "number", default:undefined},
        bgColor: {type: 'string', default: '#EBEBEB'},
        theAlignment: {type: 'string', default: 'left'}
    },
    description: "Give your audience a chace to prove their comprehension",
    // Si queremos tener una preview desde el menú admin
    example: {
        attributes: {
            question:'What is my name',
            answers: ['Meiwsakit','Barksalot','Purrsloud','Brad'],
            correctAnswer: 3,
            bgColor: '#CFE8F1',
            theAlignment: 'center'
        }
    },
    edit: EditComponents,
    save: function (props) {
        //Vista del cliente
        return null
    }
});

function EditComponents(props) {

    //Vista del admin
    function updateQuestion(value){
        props.setAttributes({question: value})
    }

    // Función que elimina un elemento del array (sin modificar estado en react)
    function deleteAnswer(indexToDelete){
        const newAnswers = props.attributes.answers.filter(function(x,index){
            return index != indexToDelete
        })
        props.setAttributes({answers: newAnswers})

        if (indexToDelete == props.attributes.correctAnswer){
            props.setAttributes({correctAnswer:undefined})
        }
    }


    function markAsCorrect(indexToCorrect){
        props.setAttributes({correctAnswer: indexToCorrect})
    }

    return (
        <div className="paying-attention-edit-block" style={{backgroundColor: props.attributes.bgColor}}>
            <BlockControls>
                <AlignmentToolbar value={props.attributes.theAlignment} onChange={x => props.setAttributes({theAlignment: x})}></AlignmentToolbar>
            </BlockControls>
            <InspectorControls>
                <PanelBody title="Background Color" initialOpen={true}>
                    <PanelRow>
                        <ChromePicker color={props.attributes.bgColor} onChangeComplete={x => props.setAttributes({bgColor: x.hex})} disableAlpcha={true} />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize:'20px'}} />
            {/* Se puede usar html normal, pero mejor usar los componentes de wordpress */}
            {/* <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor}/> */}
            {/* <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor}/> */}
            <p style={{fontSize:"13px",margin:"20px 0 8px 0"}}>Answers:</p>
            {props.attributes.answers.map(function(answer, index){
                return (
                    <Flex>
                        <FlexBlock>
                            <TextControl value={answer} autoFocus={answer == undefined} onChange={newValue =>{
                                const newAnswers = props.attributes.answers.concat([])
                                newAnswers[index] = newValue
                                props.setAttributes({answers: newAnswers})
                            }} />
                        </FlexBlock>
                        <FlexItem>
                            <Button onClick={() => markAsCorrect(index)}>
                                <Icon className="mark-as-correct" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"} />
                            </Button>
                        </FlexItem>
                        <FlexItem>
                            <Button isLink className="attention-delete" onClick={() => deleteAnswer(index) }>Delete</Button>
                        </FlexItem>
                    </Flex>
                )
            })}
            {/* Añade otra fila para meter otra respuesta */}
            <Button isPrimary onClick={() => {
                props.setAttributes({answers: props.attributes.answers.concat([undefined])})
            }}>Add another answer</Button>
        </div>
    ) 
}