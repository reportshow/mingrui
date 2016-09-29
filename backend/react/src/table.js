import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from 'material-ui/Table';
import TextField from 'material-ui/TextField';
import Toggle from 'material-ui/Toggle';
import {deepOrange500} from 'material-ui/styles/colors';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import ListItem from 'material-ui/List';
import Checkbox from 'material-ui/Checkbox';
import MultiSelect from './multiselecttab';
import SingleSelect from './singleselecttab';
import SelectField from 'material-ui/SelectField';
import RaisedButton from 'material-ui/RaisedButton';
import ReactTooltip from 'react-tooltip';

const muiTheme = getMuiTheme({
    palette: {
	accent1Color: deepOrange500,
    },
});

const styles = {
    propContainer: {
	width: 200,
        overflow: 'hidden',
	margin: '20px auto 0',
    },
    propToggleHeader: {
	margin: '20px auto 10px',
    },
};

export default class TableExampleComplex extends React.Component {
    constructor(props) {
	super(props);
	this.state = this.getDefaultState();	
    }

    componentDidMount() {
	this.filter();
    }

    getDefaultState() {
	return ({
	    queryResult: tableData,
	    fixedHeader: true,
	    fixedFooter: true,
	    stripedRows: true,
	    showRowHover: true,
	    selectable: false,
	    multiSelectable: false,
	    enableSelectAll: false,
	    deselectOnClickaway: true,
	    showCheckboxes: false,
	    adjustForCheckboxes: false,
	    height: '500px',
	    gene_value: "",
	    tblx_values: [
		"frameshift",
		"nonframeshift",
		"nonsynonymous",
		"splicing",
		"stopgain",
		"synonymous",
		"stoploss",
		"unknown"],
	    tbbl_values: [
		"0.9-1",
		"0.75-0.9",
		"0.65-0.75",
		"0.35-0.65",
		"0.2-0.35",
		"0-0.2"],
	    ycfs_values: [
		"AR",
		"AD",
		"XR",
		"XD",
		"X-LINKED"
	    ],
	    cxsd_values: [
		"10-20",
		"20+"
	    ],
	    dm_values: [
		"DM",
		"DM?",
		"[Similar]DM",
	    ],
	    qrjyz_value: "1%",
	    inhouse_value:"1%",
	});
    }
    
    rqpl_items = [
	    <ListItem key={1} value={"1%"} primaryText="1%" />,
	    <ListItem key={2} value={"2%"} primaryText="2%" />,
	    <ListItem key={3} value={"5%"} primaryText="5%" />,
    ];

    filter_gene = (data, value) => {
	var keywords = this.state.gene_value.trim().split(/\s+/);
	for(var i in keywords){
	    if(data[0].toLowerCase().indexOf(keywords[i].toLowerCase()) != -1){
		return true
	    }
	}

	return false;
    }

    filter_tblx = (data, value) => {
	for(var i in this.state.tblx_values){
	    if(data[5].toLowerCase() === this.state.tblx_values[i].toLowerCase()){	
		return true
	    }
	}

	return false;
    }

    filter_ycfs = (data, value) => {
	for(var i in this.state.ycfs_values){
	    for(var j in data[27]) {
		if(data[27][j].toLowerCase() === this.state.ycfs_values[i].toLowerCase()) {
		    return true
		}
	    }	    
	}

	return false;
    }

    filter_tbbl = (data, value) => {
	var minmax = [];
 	var data_tbbl = parseFloat(data[26].match(/.*\((.*)\).*/)[1]);
	for(var i in this.state.tbbl_values) {
	    var ret = this.state.tbbl_values[i].match(/(.*)-(.*)/);
	    minmax.push([parseFloat(ret[1]), parseFloat(ret[2])]);
	}

	for(var i in minmax) {
	    if(data_tbbl >= minmax[i][0] && data_tbbl <= minmax[i][1]) {
		return true;
	    }
	}
	
	return false;
    }  

    filter_cxsd = (data, value) => {
	var minmax = [];
 	var data_cxsd = data[26].match(/(.*)\/(.*)\(.*\)/);
	var het = parseInt(data_cxsd[1]) + parseInt(data_cxsd[2]);
	for(var i in this.state.cxsd_values) {
	    var ret = this.state.cxsd_values[i].match(/(.*)-(.*)/);
	    if(ret == null) {
		minmax.push([21, 20000]);
	    }
	    else {
		minmax.push([parseInt(ret[1]), parseInt(ret[2])]);
	    }
	}

	for(var i in minmax) {
	    if(het >= minmax[i][0] && het <= minmax[i][1]) {
		return true;
	    }
	}
	
	return false;
    }  

    filter_dm = (data, value) => {
	for(var i in this.state.dm_values){
	    if(data[2].toLowerCase() === this.state.dm_values[i].toLowerCase() && data[2].toLowerCase()!=''){
		return true
	    }
	}
	
	return false;
    }  

    filter_qrjyz = (data, value) => {
	var data_qrjyz = parseFloat(data[6][0]);
	var qrjyz_value = parseFloat(this.state.qrjyz_value);
	if(!isNaN(data_qrjyz) && !isNaN(qrjyz_value)) {
	    if(data_qrjyz <= qrjyz_value/100) {
		return true;
	    }
	}
	else {
	    return true;
	}
	return false;
    }

    filter_inhouse = (data, value) => {
	var data_inhouse = parseFloat(data[6][3]);
	var inhouse_value = parseFloat(this.state.inhouse_value);
	if(!isNaN(data_inhouse) && !isNaN(inhouse_value)) {
	    if(data_inhouse <= inhouse_value/100) {
		return true;
	    }
	}
	else {
	    return true;
	}
	return false;
    }

    filters = [
	this.filter_gene,
	this.filter_tblx,
	this.filter_ycfs,
	this.filter_tbbl,
	this.filter_cxsd,
	this.filter_dm,
	this.filter_qrjyz,
	this.filter_inhouse
    ];
    
    filter = () => {
	var queryResult = [];
	tableData.forEach(function(record){
	    var result = true;
	    for(var i in this.filters) {
		if(this.filters[i](record) == false) {
		    result = false;
		    break;
		}
	    }
	    if(result) {
		queryResult.push(record);
	    }
	}, this);
	this.setState({queryResult: queryResult});
    }
    
    handle_gene_Change = (event) => {
	this.setState({gene_value:  event.target.value}, this.filter);
    };

    handle_tblx_Change = (e,v) => {
	this.setState({tblx_values: v}, this.filter);
    };

    handle_tbbl_Change = (e,v) => {
	this.setState({tbbl_values: v}, this.filter);
    };

    handle_ycfs_Change = (e,v) => {
	this.setState({ycfs_values: v}, this.filter);
    };

    handle_cxsd_Change = (e,v) => {
	this.setState({cxsd_values: v}, this.filter);
    };

    handle_dm_Change = (e,v) => {
	this.setState({dm_values: v}, this.filter);
    };

    handle_qrjyz_Change = (event, value) => {
	this.setState({qrjyz_value: value}, this.filter);
    };
    
    handle_inhouse_Change = (event, value) => {
	this.setState({inhouse_value: value}, this.filter);
    };

    handleRowHover = (row) => {
	ReactTooltip.rebuild();
    };

    handleCarouselSlide = () => {
	this.setState(this.getDefaultState(), this.filter);
    };

    render() {
	for(var key in tableData) {
	    //疾病信息
	    var str = '';
	    for(var inkey in tableData[key][21]) {
		if(tableData[key][21][inkey]) {
		    str = str.concat(tableData[key][21][inkey][0], '--', tableData[key][21][inkey][1], '--', tableData[key][21][inkey][2], "<br/>");
		}
	    }
	    tableData[key].push(str);

	    //功能预测
	    var str='';
	    str = str.concat(
	    	'SIFT:  ', tableData[key][8], "<br/>",
	    	'PolyPhen:  ', tableData[key][9],'  ',
	    	tableData[key][10], "<br/>",
	    	'MutationTaster:  ', tableData[key][11], "<br/>",
	    	'GERP++:  ',tableData[key][12]
	    );
	    tableData[key].push(str);

	    //突变信息
	    var str = '';
	    str = tableData[key][1].replace(/\s/g, "<br/>");
	    tableData[key].push(str);
	    
	    //HET
	    for (var prop in tableData[key][15]) {
		if (tableData[key][15].hasOwnProperty(prop)) {
		    tableData[key].push(tableData[key][15][prop][1]);
		}
	    }
	    //AR AD
	    var temp = [];
	    for(var inkey in tableData[key][21]) {
		if(tableData[key][21][inkey]) {
		    temp.push(tableData[key][21][inkey][1]);
		}
	    }
	    tableData[key].push(temp);
	    //HET or other
	    for (var prop in tableData[key][15]) {
		if (tableData[key][15].hasOwnProperty(prop)) {
		    tableData[key].push(tableData[key][15][prop][0]);
		}
	    }		    
	}


	var settings = {
	    dots: false,
	    infinite: true,
	    speed: 500,
	    slidesToShow: 1,
	    slidesToScroll: 1
	};
	
	return (
<MuiThemeProvider muiTheme={muiTheme}>
  <div>
    <ReactTooltip type="info" effect="float" multiline={true}/>
    <div style={{width:'80%', marginLeft:'auto', marginRight:'auto'}}>
      <TextField name='gene' floatingLabelText="重点关注基因" defaultValue={this.state.gene_value} fullWidth={true} onChange={this.handle_gene_Change}/>
    </div>
    <div id="carousel-example-generic" className="carousel slide" data-ride="carousel" data-interval="false">
      <div className="carousel-inner">
        <div className="item active">
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px', paddingBottom:'0px'}}>
	    精准推荐
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.tblx_values} floatingLabelText="突变类型" onChange={this.handle_tblx_Change}>
		<ListItem primaryText={"frameshift"} value="frameshift" />
		<ListItem primaryText={"nonframeshift"} value="nonframeshift" />
		<ListItem primaryText={"nonsynonymous"} value="nonsynonymous" />
		<ListItem primaryText={"splicing"} value="splicing" />
		<ListItem primaryText={"stopgain"} value="stopgain" />
		<ListItem primaryText={"synonymous"} value="synonymous" />
		<ListItem primaryText={"stoploss"} value="stoploss" />
		<ListItem primaryText={"unknown"} value="unknown" />
	      </MultiSelect>
	    </div>

	    <div>
	      <MultiSelect fullWidth={true} value={this.state.cxsd_values} floatingLabelText="测序深度" onChange={this.handle_cxsd_Change}>
		<ListItem primaryText={"10-20"} value="10-20" />
		<ListItem primaryText={">20"} value="20+" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.tbbl_values} floatingLabelText="突变比例" onChange={this.handle_tbbl_Change}>
		<ListItem primaryText={"0.9-1"} value="0.9-1" />
		<ListItem primaryText={"0.75-0.9"} value="0.75-0.9" />
		<ListItem primaryText={"0.65-0.75"} value="0.65-0.75" />
		<ListItem primaryText={"0.35-0.65"} value="0.35-0.65" />
		<ListItem primaryText={"0.2-0.35"} value="0.2-0.35" />
		<ListItem primaryText={"0-0.2"} value="0-0.2" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" />
		<ListItem primaryText={"AD"} value="AD" />
		<ListItem primaryText={"XR"} value="XR" />
		<ListItem primaryText={"XD"} value="XD" />
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.dm_values} floatingLabelText="DM" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"DM"} value="DM" />
		<ListItem primaryText={"DM?"} value="DM?" />
		<ListItem primaryText={"[Similar]DM"} value="[Similar]DM" />
	      </MultiSelect>
	    </div>
	    <div>
	      <SingleSelect
		 fullWidth={true}
		 value={this.state.qrjyz_value}
		 onChange={this.handle_qrjyz_Change}
		 floatingLabelText="千人基因组携带率低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
	    </div>
	    <div>
	      <SingleSelect
		 fullWidth={true}
		 value={this.state.inhouse_value}
		 onChange={this.handle_inhouse_Change}
		 floatingLabelText="inhouse低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
	    </div>
	  </div>
        </div>

        <div className="item">
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px'}}>
	    自选过滤
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>
	    	    <div>
	      <MultiSelect fullWidth={true} value={this.state.tblx_values} floatingLabelText="突变类型" onChange={this.handle_tblx_Change}>
		<ListItem primaryText={"frameshift"} value="frameshift" />
		<ListItem primaryText={"nonframeshift"} value="nonframeshift" />
		<ListItem primaryText={"nonsynonymous"} value="nonsynonymous" />
		<ListItem primaryText={"splicing"} value="splicing" />
		<ListItem primaryText={"stopgain"} value="stopgain" />
		<ListItem primaryText={"synonymous"} value="synonymous" />
		<ListItem primaryText={"stoploss"} value="stoploss" />
		<ListItem primaryText={"unknown"} value="unknown" />
	      </MultiSelect>
	    </div>

	    <div>
	      <MultiSelect fullWidth={true} value={this.state.cxsd_values} floatingLabelText="测序深度" onChange={this.handle_cxsd_Change}>
		<ListItem primaryText={"10-20"} value="10-20" />
		<ListItem primaryText={">20"} value="20+" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.tbbl_values} floatingLabelText="突变比例" onChange={this.handle_tbbl_Change}>
		<ListItem primaryText={"0.9-1"} value="0.9-1" />
		<ListItem primaryText={"0.75-0.9"} value="0.75-0.9" />
		<ListItem primaryText={"0.65-0.75"} value="0.65-0.75" />
		<ListItem primaryText={"0.35-0.65"} value="0.35-0.65" />
		<ListItem primaryText={"0.2-0.35"} value="0.2-0.35" />
		<ListItem primaryText={"0-0.2"} value="0-0.2" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" />
		<ListItem primaryText={"AD"} value="AD" />
		<ListItem primaryText={"XR"} value="XR" />
		<ListItem primaryText={"XD"} value="XD" />
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.dm_values} floatingLabelText="DM" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"DM"} value="DM" />
		<ListItem primaryText={"DM?"} value="DM?" />
		<ListItem primaryText={"[Similar]DM"} value="[Similar]DM" />
	      </MultiSelect>
	    </div>
	    <div>
	      <SingleSelect
		 fullWidth={true}
		 value={this.state.qrjyz_value}
		 onChange={this.handle_qrjyz_Change}
		 floatingLabelText="千人基因组携带率低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
	    </div>
	    <div>
	      <SingleSelect
		 fullWidth={true}
		 value={this.state.inhouse_value}
		 onChange={this.handle_inhouse_Change}
		 floatingLabelText="inhouse低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
	    </div>
	  </div>
        </div>

        <a className="left carousel-control" style={{width:'5%'}} href="#carousel-example-generic" data-slide="prev" onClick={this.handleCarouselSlide}>
          <span className="fa fa-angle-left"></span>
        </a>
        <a className="right carousel-control" style={{width:'5%'}} href="#carousel-example-generic" data-slide="next" onClick={this.handleCarouselSlide}>
          <span className="fa fa-angle-right"></span>
        </a>
      </div>
  
      <Table
	 height={this.state.height}
	 fixedHeader={this.state.fixedHeader}
	 fixedFooter={this.state.fixedFooter}
	 selectable={this.state.selectable}
	 multiSelectable={this.state.multiSelectable}
	 onRowHover = {this.handleRowHover}
	 className = 'exportable'
	 >
	<TableHeader
	   displaySelectAll={this.state.showCheckboxes}
	   adjustForCheckbox={this.state.adjustForCheckboxes}
	   enableSelectAll={this.state.enableSelectAll}
	   >
	  <TableRow>
	    <TableHeaderColumn colSpan="4" style={{verticalAlign: 'bottom', fontWeight:'bold', fontSize:'120%'}}>当前选择：{this.state.queryResult.length} /{tableData.length}(筛选/全部)
	    </TableHeaderColumn>
	    <TableHeaderColumn  colSpan="3" style={{verticalAlign: 'bottom', textAlign:'right'}}>
		<a href="#" className="export_button" style={{color: 'blue'}}>下载过滤结果</a>
	    </TableHeaderColumn>
	  </TableRow>
	  <TableRow>
	    <TableHeaderColumn tooltip="基因(大小)">基因(大小)</TableHeaderColumn>
	    <TableHeaderColumn tooltip="突变信息">突变信息</TableHeaderColumn>
	    <TableHeaderColumn tooltip="突变类型">突变类型</TableHeaderColumn>
	    <TableHeaderColumn tooltip="基因疾病信息">基因疾病信息</TableHeaderColumn>
	    <TableHeaderColumn tooltip="测序深度和比例">测序深度和比例</TableHeaderColumn>
	    <TableHeaderColumn tooltip="HGMD信息">HGMD</TableHeaderColumn>
	    <TableHeaderColumn tooltip="功能预测">功能预测</TableHeaderColumn>
	  </TableRow>
	</TableHeader>
	<TableBody
	   displayRowCheckbox={this.state.showCheckboxes}
	   deselectOnClickaway={this.state.deselectOnClickaway}
	   showRowHover={this.state.showRowHover}
	   stripedRows={this.state.stripedRows}
	   >
	  {this.state.queryResult.map( (row, index) => (
	  <TableRow key={index} selected={row.selected}>
	    <TableRowColumn data-tip={row[0] +'(' + row[19] + ')'}>{row[0] +'(' + row[19] + ')'}</TableRowColumn>//基因
	    <TableRowColumn data-tip={row[25]}>{row[25]}</TableRowColumn>//突变信息
	    <TableRowColumn data-tip={row[5]}>{row[5]}</TableRowColumn>//突变类型
	    <TableRowColumn data-tip={row[23]}>{row[23]}</TableRowColumn>//疾病信息
	    <TableRowColumn data-tip={row[28] + '<br/>' +row[26]}>{row[28]}<br/>{row[26]}</TableRowColumn>//HET
	    <TableRowColumn data-tip={row[22]}>{row[22]}</TableRowColumn>//HGDM
	    <TableRowColumn data-tip={row[24]}><a>详情</a></TableRowColumn>//功能预测
	  </TableRow>
	  ))}
	</TableBody>
      </Table>
    </div>
  </div>
</MuiThemeProvider>
	);
    }
}
