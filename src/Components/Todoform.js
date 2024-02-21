import React, {useState} from 'react';

function Todoform(props) {
    const [inputText,setInputText] = useState('');
    const handleEnterPress = (e)=>{
        if(e.keyCode===13){
            props.addList(inputText)
            setInputText("")
        }
    }
  return (
    <div className="form-cointainer">
        <input 
        type="text" 
        className='form-todo'
        placeholder="Enter your to do"
        value={inputText}
        onChange={e=>{
            setInputText(e.target.value)
            }}
            onKeyDown={handleEnterPress}
            />
        <button className="add" 
        onClick={()=>{
            props.addList(inputText)
        setInputText("")
        }}>追加</button>
    
    </div>
  );
}

export default Todoform;