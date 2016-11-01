import React from 'react';

class MultiSelectTBLX extends React.Component {    
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

	if(floatingLabelText.length>9)
	{
	    var marginleft ='60px'
	}
	else {
	    var marginleft = 'auto'
	}

	var line1 = [];
	var line2 = [];
	var linebreak = false;
	children.map((item, i) => {
	    if(item.props.value ==='br') {
		linebreak = true;
		return;
	    }
	    if(linebreak) {
		line2.push(item);
	    }
	    else {
		line1.push(item);
	    }
	}
		    );
	
	
	return (
<div style={{width: "100%"}}>
  <div className="sys_item_spec">
    <dl className="clearfix iteminfo_parameter sys_item_specpara" data-sid="1">
      <dt>{floatingLabelText}</dt>
      <dd>
	<ul className="sys_spec_text" style={{marginLeft: marginleft}}>
		{
		    line1.map((item, i) => {
			if(item.props.value ==='ph') {
			    return  <li key={i} style={{marginLeft:'20px'}}></li>;
			}
			    
			return (
		    		<li key={i} className={value.indexOf(item.props.value) >= 0 ? 'selected': ''}>
		    		  <a href="javascript:;" onClick={(event) =>{
				      const index = value.indexOf(item.props.value);
				      if(index < 0) {
					  if(item.props.value ==='') {
					      value.length = 0;
					  }
					  else {
					      const index1 = value.indexOf('');
					      if(index1 >= 0) {
						  value.splice(index1, 1);
					      }
					  }
				      	  value.push(item.props.value);
				      	  if(this.props.onChange) this.props.onChange(event, value);
				      } else if(index >= 0) {
					  if(item.props.value ==='') {;
					  }
					  else {
					      value.splice(index, 1);
					      if(this.props.onChange) this.props.onChange(event, value);
					  }
				      }
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
    
    <dl className="clearfix iteminfo_parameter sys_item_specpara">
      <dt></dt>
      <dd> 
	<ul className="sys_spec_text">
		{
		    line2.map((item, i) => {
			if(item.props.value ==='ph') {
			    return  <li key={i} style={{marginLeft:'20px'}}></li>;
			}
			
			return (
		    		<li key={i} className={value.indexOf(item.props.value) >= 0 ? 'selected': ''}>
		    		<a href="javascript:;" onClick={(event) =>{
				    const index = value.indexOf(item.props.value);
				    if(index < 0) {
					if(item.props.value ==='') {
					    value.length = 0;
					}
					else {
					    const index1 = value.indexOf('');
					    if(index1 >= 0) {
						value.splice(index1, 1);
					    }
					}
				      	value.push(item.props.value);
				      	if(this.props.onChange) this.props.onChange(event, value);
				    } else if(index >= 0) {
					if(item.props.value ==='') {
					    ;
					}
					else {
					    value.splice(index, 1);
					    if(this.props.onChange) this.props.onChange(event, value);
					}
				    }
				}				     
							       }
				>
				{item.props.primaryText}</a>
		    		<i></i>
		    		</li>
			);
		    })
		}
		<i onMouseEnter={()=>{$('#tiptblx').show();}}
		  onMouseLeave={()=>{$('#tiptblx').hide();}}
		  onTouchStart={()=>{$('#tiptblx').show();}}
		  className="fa fa-fw fa-question" />	
	</ul>
      </dd>
    </dl>
  </div>	
</div>
	);
    }
}

export default MultiSelectTBLX;
