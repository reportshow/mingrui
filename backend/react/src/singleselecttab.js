import React from 'react';

class SingleSelect extends React.Component {    
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
	
	if(floatingLabelText.length>5)
	{
	    var marginleft ='62px'
	}
	else {
	    var marginleft = 'auto'
	}
	
	return (
<div style={{width: "100%"}}>
  <div className="sys_item_spec">
    <dl className="clearfix iteminfo_parameter sys_item_specpara" data-sid="1">
      <dt>{floatingLabelText}</dt>
      <dd>
	<ul className="sys_spec_text" style={{marginLeft: marginleft}}>
		{
		    children.map((item, i) => {
			return (
		    		<li key={i} className={value == item.props.value ? 'selected': ''}>
		    		  <a href="javascript:;" onClick={(event) =>{
				      if(this.props.onChange) this.props.onChange(event, item.props.value);
				  }
								 } 
				>
				  {item.props.primaryText}</a>
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

export default SingleSelect;
