import React from 'react';

class MultiSelect extends React.Component {

    handleClick = (event) =>{
	var i=$(event.target).parent();
	if(!!i.hasClass("selected")){
	    i.removeClass("selected");
	}else{
	    i.addClass("selected");
	}
    }
    
    render() {
	const {
	    autoWidth,
	    children,
	    style,
	    labelStyle,
	    iconStyle,
	    underlineDisabledStyle,
	    underlineFocusStyle,
	    underlineStyle,
	    errorStyle,
	    selectFieldRoot,
	    disabled,
	    floatingLabelText,
	    floatingLabelStyle,
	    hintStyle,
	    hintText,
	    fullWidth,
	    errorText,
	    onFocus,
	    onBlur,
	    onChange,
	    value,
		...other
	} = this.props;

	let labels = [];
	for(let i in children) {
	    if(value.indexOf(children[i].props.value) >= 0) {
		labels.push(children[i].props.primaryText);
	    }
	}

	if(labels.length === 0) {
	    labels.push("None");
	}

	return (

<div style={{width: "100%"}}>
  <div className="sys_item_spec">
    <dl className="clearfix iteminfo_parameter sys_item_specpara" data-sid="1">
      <dt>{floatingLabelText}</dt>
      <dd>
	<ul className="sys_spec_text">
		{
		    children.map((item, i) => {
			return (
		    		<li data-aid="3" key={i}>
		    		<a href="javascript:;" onClick={this.handleClick}>{item.props.primaryText}</a>
		    		<i></i>
		    		</li>
			);
		    })
		}
	</ul>
      </dd>
    </dl>
  </div>	
</div>
	);
    }
}

export default MultiSelect;
