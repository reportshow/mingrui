/**
 * Material UI multi select
 *
 * Use with: 
 * <MultiSelect fullWidth={true} value={this.state.values} onChange={(e,v) => this.setState({values: v})}>
 *         <ListItem primaryText={"Option 1"} value={1} />
 *         <ListItem primaryText={"Option 2"} value={2} />
 *         <ListItem primaryText={"Option 3"} value={3} />
 *         <ListItem primaryText={"Option 4"} value={4} />
 * </MultiSelect>
 * 
 * this.state.values is an array of the values which are currently selected.
 **/
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

	return (

  <DropDownMenu
     autoWidth={autoWidth}
     {...other}
     >
    
    {children.map((item, i) => (
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
	}}
	    />
    ))
    }	    
  </DropDownMenu>
	);
    }
}

export default MultiSelect;

