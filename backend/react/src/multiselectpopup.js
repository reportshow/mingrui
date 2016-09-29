import React from 'react';
import SelectField from 'material-ui/SelectField';
import TextField from 'material-ui/TextField';
import DropDownMenu from 'material-ui/DropDownMenu';
import Checkbox from 'material-ui/Checkbox';

class MultiSelect extends SelectField {
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
		<div style={{position:"absolute", bottom: 12, left:0, width: "100%", overflow:"hidden" }}>{floatingLabelText}</div>
		<DropDownMenu
		   disabled={disabled}
		   style={{width:"100%"}}
		   labelStyle={labelStyle}
		   iconStyle={iconStyle}
		   autoWidth={autoWidth}
		   value=""
		   {...other}
		   >
		  {
		      children.map((item, i) => {
			  return (
				  <Checkbox
				     key={i}
				     label = {item.props.primaryText}
				     checked={value.indexOf(item.props.value) >= 0}
				    onCheck={(e,v) => {
				    const index = value.indexOf(item.props.value);
					if(v === true) {
					    if(index < 0) {
						value.push(item.props.value);
						if(this.props.onChange) this.props.onChange(e, value);
					    }
					} else {
					    if(index >= 0) {
						value.splice(index, 1);
						if(this.props.onChange) this.props.onChange(e, value);
					    }
					}
				    }
					    }
				  />
			  );


		      }
				  )
		  }
		</DropDownMenu>
		</div>
	);
    }
}

export default MultiSelect;
