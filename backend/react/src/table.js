import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from 'material-ui/Table';
import TextField from 'material-ui/TextField';
import {deepOrange500} from 'material-ui/styles/colors';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import ListItem from 'material-ui/List';
import Checkbox from 'material-ui/Checkbox';
import MultiSelect from './multiselecttab';
import MultiSelectTBLX from './multiselecttab_tblx';
import MultiSelectHGDM from './multiselecttab_hgdm';
import SingleSelect from './singleselecttab';
import SelectField from 'material-ui/SelectField';
import RaisedButton from 'material-ui/RaisedButton';
import FlatButton from 'material-ui/FlatButton';
import ReactTooltip from 'react-tooltip';

const muiTheme = getMuiTheme({
    palette: {
	accent1Color: deepOrange500,
    },
});

export default class TableExampleComplex extends React.Component {
    constructor(props) {
	super(props);
	this.state = this.getDefaultState();	
    }

    componentDidMount() {
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
	    	'PolyPhen:  ', tableData[key][9],"<br/>",
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

	    //正常人群携带率
	    var qrjyz = parseFloat(tableData[key][6][0]);
	    if(tableData[key][6][0] === null) {
		qrjyz = '-';
	    }
	    var inhouse = parseFloat(tableData[key][6][2]);
	    if(tableData[key][6][2] === null) {
		inhouse = '-';
	    }
	    tableData[key].push(qrjyz + '<br/>' + inhouse);

	}
	    
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
		"0.2-0.9",],
	    ycfs_values: [
		"AR",
		"AD",
		"XR",
		"XD",
		"X-LINKED",
		"不明"
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
	    <ListItem key={1} value={"0"} primaryText="0" />,
	    <ListItem key={1} value={"1%"} primaryText="1%" />,
	    <ListItem key={2} value={"2%"} primaryText="2%" />,
	    <ListItem key={3} value={"5%"} primaryText="5%" />,
	    <ListItem key={3} value={"100%"} primaryText="不筛选" />,
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
	if(this.state.tblx_values[0] ==='') {
	    return true;
	}
	    
	for(var i in this.state.tblx_values){
	    if(data[5].toLowerCase() === this.state.tblx_values[i].toLowerCase()){	
		return true
	    }
	}

	return false;
    }

    filter_ycfs = (data, value) => {
	if(this.state.ycfs_values[0] === '') {
	    return true;
	}
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
	    if((data[2].toLowerCase() === this.state.dm_values[i].toLowerCase() && data[2].toLowerCase()!='') || this.state.dm_values[i].toLowerCase() === '') {
		return true
	    }
	}

	return false;
    }  

    filter_qrjyz = (data, value) => {
	var data_qrjyz = parseFloat(data[6][0]);
	if(data[6][0] === null) {
	    data_qrjyz = 0;
	}
	var qrjyz_value = parseFloat(this.state.qrjyz_value);
	
	if(!isNaN(data_qrjyz) && !isNaN(qrjyz_value)) {
	    if(data_qrjyz <= qrjyz_value/100) {
		return true;
	    }
	}

	return false;
    }

    filter_inhouse = (data, value) => {
	var data_inhouse = parseFloat(data[6][2]);
	if(data[6][2] === null) {
	    data_inhouse = 0;
	}
	var inhouse_value = parseFloat(this.state.inhouse_value);
	
	if(!isNaN(data_inhouse) && !isNaN(inhouse_value)) {
	    if(data_inhouse <= inhouse_value/100) {
		return true;
	    }
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
	this.setState({queryResult: queryResult}, ReactTooltip.rebuild);
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
    
    handleGeneClear = () => {
	this.setState({gene_value:""}, this.filter);
    };

    render() {
	return (
<MuiThemeProvider muiTheme={muiTheme}>
  <div>
    <ReactTooltip type="info" effect="float" multiline={true} />
    <div style={{width:'80%', marginLeft:'auto', marginRight:'auto'}}>
      <TextField name='gene' floatingLabelText="重点关注基因" value={this.state.gene_value} onChange={this.handle_gene_Change} style={{width:'80%'}}/>
      <FlatButton label="清除所有基因" primary={true} onClick={this.handleGeneClear}/>
    </div>
    <div id="carousel-example-generic" className="carousel slide" data-ride="carousel" data-interval="false">
      <div className="carousel-inner">
        <div className="item active">
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px', paddingBottom:'0px'}}>
	    <span onMouseEnter={()=>{$('#tip').show();}}
	      onMouseLeave={()=>{$('#tip').hide();}}
	      onTouchStart={()=>{$('#tip').show();}}>精准推荐</span>
	    <i className="fa fa-fw fa-question"/>
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>
	    <div id='tip' className="callout callout-info" style={{display:'none'}}>
              <h4>精准推荐过滤说明！</h4>
              <p>每个指标都是精心挑选的，只要按照这个顺序来挑选就能得到我们预期的结果</p>
	    </div>
	      
	    <div>
	      <MultiSelectHGDM fullWidth={true} value={this.state.dm_values} floatingLabelText="HGMD" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"DM"} value="DM" />
		<ListItem primaryText={"DM?"} value="DM?" />
		<ListItem primaryText={"[Similar]DM"} value="[Similar]DM" />
		<ListItem primaryText={"不筛选"} value="" />
	      </MultiSelectHGDM>
	      <div id='tipdm' className="callout callout-info" style={{display:'none'}}>
              <h4>HGMD！</h4>
              <p>HGDM说明</p>
	    </div>
	    </div>
	    <div>
	      <MultiSelectTBLX fullWidth={true} value={this.state.tblx_values} floatingLabelText="突变类型" onChange={this.handle_tblx_Change}>
		<ListItem primaryText={"frameshift"} value="frameshift" />
		<ListItem primaryText={"stopgain"} value="stopgain" />
		<ListItem primaryText={"splicing"} value="splicing" />
		<ListItem primaryText={"stoploss"} value="stoploss" />
		<ListItem primaryText={""} value="br" />
		<ListItem primaryText={"nonsynonymous"} value="nonsynonymous" />
		<ListItem primaryText={"nonframeshift"} value="nonframeshift" />
		<ListItem primaryText={"synonymous"} value="synonymous" />
		<ListItem primaryText={"unknown"} value="unknown" />
		<ListItem primaryText={"不筛选"} value="" />
	      </MultiSelectTBLX>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" />
		<ListItem primaryText={"AD"} value="AD" />
		<ListItem primaryText={"XR"} value="XR" />
		<ListItem primaryText={"XD"} value="XD" />
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" />
		<ListItem primaryText={"不明"} value="不明" />
		<ListItem primaryText={"不筛选"} value="" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.cxsd_values} floatingLabelText="测序深度" onChange={this.handle_cxsd_Change}>
		<ListItem primaryText={"10-20"} value="10-20" />
		<ListItem primaryText={">20"} value="20+" />
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
		 floatingLabelText="本地人携带率低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.tbbl_values} floatingLabelText="突变比例" onChange={this.handle_tbbl_Change}>
		<ListItem primaryText={"0.9-1"} value="0.9-1" />
		<ListItem primaryText={"0.2-0.9"} value="0.2-0.9" />
		<ListItem primaryText={"0-0.2"} value="0-0.2" />
	      </MultiSelect>
	    </div>
	  </div>
        </div>

        <div className="item">
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px'}}>
	    自选过滤
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>
	    <div>
		<MultiSelect fullWidth={true} value={this.state.dm_values} www={"dmdmetc."} floatingLabelText="HGMD" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"DM"} value="DM" dataTip="1"/>
		<ListItem primaryText={"DM?"} value="DM?" dataTip="1"/>
		<ListItem primaryText={"[Similar]DM"} value="[Similar]DM" dataTip="1"/>
		<ListItem primaryText={"不筛选"} value="" dataTip="1"/>
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelectTBLX fullWidth={true} value={this.state.tblx_values} floatingLabelText="突变类型" onChange={this.handle_tblx_Change}>
		<ListItem primaryText={"frameshift"} value="frameshift" />
		<ListItem primaryText={"stopgain"} value="stopgain" />
		<ListItem primaryText={"splicing"} value="splicing" />
		<ListItem primaryText={"stoploss"} value="stoploss" />
		<ListItem primaryText={""} value="ph" />
		<ListItem primaryText={"nonsynonymous"} value="nonsynonymous" />
		<ListItem primaryText={""} value="br" />
		<ListItem primaryText={"nonframeshift"} value="nonframeshift" />
		<ListItem primaryText={"synonymous"} value="synonymous" />
		<ListItem primaryText={"unknown"} value="unknown" />
		<ListItem primaryText={"不筛选"} value="" />
	      </MultiSelectTBLX>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" />
		<ListItem primaryText={"AD"} value="AD" />
		<ListItem primaryText={"XR"} value="XR" />
		<ListItem primaryText={"XD"} value="XD" />
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" />
		<ListItem primaryText={"不明"} value="不明" />
		<ListItem primaryText={"不筛选"} value="" />
	      </MultiSelect>
	    </div>
	    <div>
	      <MultiSelect fullWidth={true} value={this.state.cxsd_values} floatingLabelText="测序深度" onChange={this.handle_cxsd_Change}>
		<ListItem primaryText={"10-20"} value="10-20" />
		<ListItem primaryText={">20"} value="20+" />
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
		 floatingLabelText="本地人携带率低于"
		 >
		{this.rqpl_items}
	      </SingleSelect>
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

	  </div>
        </div>

        <a className="left carousel-control" style={{width:'5%'}} href="#carousel-example-generic" data-slide="prev" onClick={this.handleCarouselSlide}>
          <span className="fa fa-angle-left"></span>
        </a>
        <a className="right carousel-control" style={{width:'5%'}} href="#carousel-example-generic" data-slide="next" onClick={this.handleCarouselSlide}>
          <span className="fa fa-angle-right"></span>
        </a>
      </div>
      <table id="result" style={{backgroundColor: 'rgb(255, 255, 255)', padding: '0px 24px', width: '100%', borderCollapse: 'collapse', borderSpacing:'0px', tableLayout: 'fixed', fontFamily: 'Roboto, sans-serif'}}>
	
	<TableHeader
	   displaySelectAll={this.state.showCheckboxes}
	   adjustForCheckbox={this.state.adjustForCheckboxes}
	   enableSelectAll={this.state.enableSelectAll}
	   >
	  <TableRow>
		<TableHeaderColumn colSpan="4" style={{verticalAlign: 'bottom', fontWeight:'bold', fontSize:'120%', overflow:'hidden'}} data-tip={"当前选择：" +this.state.queryResult.length +'/'+tableData.length+"(筛选/全部)"}>当前选择：{this.state.queryResult.length} /{tableData.length}(筛选/全部)
	    </TableHeaderColumn>
	    <TableHeaderColumn  colSpan="3" style={{verticalAlign: 'bottom', textAlign:'right'}}>
	      <a id='export' data-type="xls" href="javascript:;" style={{color: 'blue', overflow:'hidden'}}>下载过滤结果</a>
	    </TableHeaderColumn>
	  </TableRow>
	  <TableRow>
	    <TableHeaderColumn data-tip="基因(大小)" style={{overflow:'hidden'}}>基因(大小)</TableHeaderColumn>
	    <TableHeaderColumn data-tip="突变信息" style={{overflow:'hidden'}}>突变信息</TableHeaderColumn>
	    <TableHeaderColumn data-tip="突变类型" style={{overflow:'hidden'}}>突变类型</TableHeaderColumn>
	    <TableHeaderColumn data-tip="基因疾病信息" style={{overflow:'hidden'}}>基因疾病信息</TableHeaderColumn>
	    <TableHeaderColumn data-tip="测序深度和比例" style={{overflow:'hidden'}}>测序深度和比例</TableHeaderColumn>
	    <TableHeaderColumn data-tip="HGMD信息" style={{overflow:'hidden'}}>HGMD</TableHeaderColumn>
	    <TableHeaderColumn data-tip="正常人群携带率" style={{overflow:'hidden'}}>正常人群携带率</TableHeaderColumn>
	    <TableHeaderColumn data-tip="功能预测" style={{overflow:'hidden'}}>功能预测</TableHeaderColumn>
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
	    <TableRowColumn data-tip={row[0] +'(' + row[19] + ')'} style={{position:'relative'}}>{row[0] +'(' + row[19] + ')'}</TableRowColumn>//基因
	    <TableRowColumn data-tip={row[25]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[25]}} />//突变信息
	    <TableRowColumn data-tip={row[5]} style={{position:'relative'}}>{row[5]}</TableRowColumn>//突变类型
	    <TableRowColumn data-tip={row[23]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[23]}} />//疾病信息
	    <TableRowColumn data-tip={row[28] + '<br/>' +row[26]} style={{position:'relative'}}>{row[28]}<br/>{row[26]}</TableRowColumn>//HET
	    <TableRowColumn data-tip={row[22]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[22]}} />//HGDM
	    <TableRowColumn data-tip={row[29]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[29]}} />//正常人群携带率
	    <TableRowColumn data-tip={row[24]} style={{position:'relative'}}><a>详情</a></TableRowColumn>//功能预测
	  </TableRow>
	  ))}
	</TableBody>
      </table>
    </div>
  </div>
</MuiThemeProvider>
	);
    }
}
