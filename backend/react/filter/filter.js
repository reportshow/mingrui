import React from 'react';

import ReactTooltip from 'react-tooltip';

export default class Filter extends React.Component {
    constructor(props) {
	super(props);
	this.state = this.getDefaultState();	
    }

    componentDidMount() {

    }

    getDefaultState() {
	return ({
	    filters: filters,
	});
    }

    handleSave = (e) => {
	e.preventDefault();
	var fitlers = this.state.filters;
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	var str_date = year + '-' + month + '-' + day;
	filters.unshift({date:str_date, description:newfilter.note.value, filter:"akjdfkfjjf"});
	this.setState({filters:filters});
    };

    handleDelete = (e) => {
	return false;
    }

    handleLoad = (e) => {
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
    <div className="box-footer">
      <button type="submit" className="btn btn-primary">保存</button>
    </div>
  </form>
  <div className="box box-solid">
    <div className="box-header with-border">
      <i className="fa fa-text-width"></i>
      <h3 className="box-title">已保存的过滤条件</h3>
    </div>
    <div className="box-body">
      <dl>
	  {this.state.filters.map( (filter, index) => (
	  <dt key={index} data-tip={filter.description}>{filter.date}&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick={this.handleLoad(filter)}><i className="fa fa-upload"></i></a>&nbsp;&nbsp;<a href="#" onClick={this.handleDelete(filter)}><i className="fa fa-trash-o"></i></a></dt>
	  ))}
      </dl>
    </div>
  </div>
</div>
	);
    }
}
