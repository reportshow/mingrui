import React from 'react';

import ReactTooltip from 'react-tooltip';

export default class Filter extends React.Component {
    constructor(props) {
	super(props);
	this.state = this.getDefaultState();	
    }

    componentDidMount() {
	//load saved filters from server
	$.get('/backend/web/index.php?r=filter/list&report_id=' + report_id + '&user_id=' + user_id,
	      (result) =>{
		  var filters = JSON.parse(result);
		  this.setState({filters: filters}, ReactTooltip.rebuild);
	      });
	eh.addListener('filterchange', this.handleFilterChange);
    }

    getDefaultState() {
	return ({
	    filters: [],
	});
    }

    handleFilterChange = (filter) => {
	this.setState({presentfilters: filter}, ReactTooltip.rebuild);
    }
    
    handleSave = (e) => {
	e.preventDefault();
	var filters = this.state.filters;
	
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	var title = year + '-' + month + '-' + day;
	var filter_json = this.state.presentfilters;
	var filter = [-1,
		      newfilter.note.value,
		      title,
		      report_type,
		      user_id,
		      report_id,
		      filter_json
		     ];
	//save the new filters to server
	var str_filter = JSON.stringify(filter);
	$.get('/backend/web/index.php?r=filter/filteradd&str_filter=' + str_filter,
	      (result)=>{
		  filter[0] = result;
	      }
	     );

	filters.unshift(filter);
	newfilter.note.value = '';
	this.setState({filters:filters}, ReactTooltip.rebuild);	
    };

    handleDelete(filter) {
	var filters = this.state.filters;
	for(var i = filters.length; i--;) {
	    if(filters[i] === filter) {
		filters.splice(i, 1);
	    }
	}
	this.setState({filters:filters}, ReactTooltip.rebuild);
	//remove the filters from server
	if(filter[0] != -1) {
	    $.get('/backend/web/index.php?r=filter/filterdelete&id=' + filter[0]);
	}
	
	return false;
    }

    handleLoad(filter) {
	console.log(filter);
	eh.emitEvent('filterload', [filter[6]]);

	return false;
    }
    
    render() {
	return (
<div>
  <ReactTooltip type="info" effect="float" multiline={true} />
  <div className="box-header with-border">
    <h3 className="box-title">保存当前过滤条件</h3>
  </div>
  <form role="form" name="newfilter" onSubmit={this.handleSave}>
    <div className="box-body">
      <div className="form-group">
	<label>条件备注</label>
	<textarea className="form-control" rows="3" id="note" name="note" placeholder="写点什么吧"></textarea>
      </div>
    </div>
    <button type="submit" className="btn btn-primary">保存</button>
  </form>
  <div className="box-footer">
  </div>
  <div className="box box-solid">
    <div className="box-header with-border">
      <i className="fa fa-text-width"></i>
      <h3 className="box-title">已保存的过滤条件</h3>
    </div>
    <div className="box-body">
      <dl>
	  {this.state.filters.map( (filter, index) => (
		  <dt key={index} data-tip={filter[1]}>{filter[2]}&nbsp;&nbsp;&nbsp;&nbsp;<a onClick={()=>this.handleLoad(filter)}><i className="fa fa-upload"></i></a>&nbsp;&nbsp;<a onClick={()=>this.handleDelete(filter)}><i className="fa fa-trash-o"></i></a></dt>
	  ))}
      </dl>
    </div>
  </div>
</div>
	);
    }
}
