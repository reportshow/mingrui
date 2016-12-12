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
import MultiSelectYCFS from './multiselecttab_ycfs';
import SingleSelect from './singleselecttab';
import SingleSelectHGDM from './singleselecttab_hgdm';
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
	    for(var inkey in tableData[key][17]) {
	    	if(tableData[key][17][inkey]) {
	    	    str = str.concat(tableData[key][17][inkey][1], '--', tableData[key][17][inkey][0], '--', tableData[key][17][inkey][2], "<br/>");
	    	}
	    }
	    tableData[key].push(str);

	    //功能预测
	    var str='';
	    str = str.concat(
	    	'SIFT:  ', tableData[key][13], "<br/>",
	    	'PolyPhen:  ', tableData[key][14],"<br/>",
	    	'MutationTaster:  ', tableData[key][15], "<br/>",
	    	'GERP++:  ',tableData[key][16]
	    );
	    tableData[key].push(str);

	    //突变信息
	    var str = '';
	    str = tableData[key][1] + '<br/>' + tableData[key][2] + '<br/>' + tableData[key][3];
	    tableData[key].push(str);
	    
	    //HET
	    var str = '';
	    str = tableData[key][4] + '<br/>' + tableData[key][5];
	    tableData[key].push(str);

	    // //AR AD
	    // var temp = [];
	    // for(var inkey in tableData[key][21]) {
	    // 	if(tableData[key][21][inkey]) {
	    // 	    temp.push(tableData[key][21][inkey][1]);
	    // 	}
	    // }
	    // tableData[key].push(temp);

	    // //HET or other
	    // for (var prop in tableData[key][15]) {
	    // 	if (tableData[key][15].hasOwnProperty(prop)) {
	    // 	    tableData[key].push(tableData[key][15][prop][0]);
	    // 	}
	    // }
	    
	    //正常人群携带率
	    tableData[key].push( tableData[key][10]+ '<br/>' + tableData[key][11]);

	    //HGMD
	    var str = '';
	    str = tableData[key][7] + '<br/>' + tableData[key][8] + '<br/>' + tableData[key][9];
	    tableData[key].push(str);
	    tableData[key].push(key);
	    tableData[key].push(false);
	}
	    
	this.filter();

	$('#carousel-filter').on('slid.bs.carousel', () => {
	    if(this.state.jingzhun) {
		this.setState(this.getFreeState(), this.filter);
	    }
	    else
	    {
		this.setState(this.getDefaultState(), this.filter);
	    }
	});

	eh.addListener('filterload', this.handleFilterLoad);
    }

    getDefaultState() {
	return ({
	    queryResult: [],
	    fixedHeader: false,
	    fixedFooter: false,
	    stripedRows: true,
	    showRowHover: true,
	    selectable: true,
	    multiSelectable: true,
	    enableSelectAll: true,
	    deselectOnClickaway: false,
	    showCheckboxes: true,
	    adjustForCheckboxes: true,
	    height: '500px',
	    gene_value: "",
	    tblx_values: [
		""],
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
	    dm_values: "1",
	    qrjyz_value: "2%",
	    inhouse_value:"1%",
	    jingzhun: true,
	    selected: [],
	    count: 0,
	});
    }

    getFreeState() {
	return ({
	    queryResult: [],
	    fixedHeader: false,
	    fixedFooter: false,
	    stripedRows: true,
	    showRowHover: true,
	    selectable: true,
	    multiSelectable: true,
	    enableSelectAll: true,
	    deselectOnClickaway: false,
	    showCheckboxes: true,
	    adjustForCheckboxes: true,
	    height: '500px',
	    gene_value: "",
	    tblx_values: [""],
	    tbbl_values: [
		"0.9-1",
		"0.2-0.9",],
	    ycfs_values: [""],
	    cxsd_values: [
		"10-20",
		"20+"
	    ],
	    dm_values: "3",
	    qrjyz_value: "100%",
	    inhouse_value:"100%",
	    jingzhun: false,
	    selected: [],
	    count: 0,
	});
    }
    
    rqpl_items = [
	    <ListItem key={1} value={"0"} primaryText="0" />,
	    <ListItem key={2} value={"1%"} primaryText="1%" />,
	    <ListItem key={3} value={"2%"} primaryText="2%" />,
	    <ListItem key={4} value={"5%"} primaryText="5%" />,
	    <ListItem key={5} value={"100%"} primaryText="不筛选" />,
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
	    if(data[6].toLowerCase() === this.state.tblx_values[i].toLowerCase()){	
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
	    for(var j in data[17]) {
		if(data[17][j][0].toLowerCase() === this.state.ycfs_values[i].toLowerCase()) {
		    return true
		}
	    }	    
	}

	return false;
    }

    filter_tbbl = (data, value) => {
	var minmax = [];
 	var data_tbbl = parseFloat(data[5].match(/.*\((.*)\).*/)[1]);
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
 	var data_cxsd = data[5].match(/(.*)\/(.*)\(.*\)/);
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
	if(this.state.dm_values === "3") {
	    return true
	}
	if(this.state.dm_values === "1" && data[7].length > 0 && data[7] !='-')
	{
	    return true;
	}
	if(this.state.dm_values === "2" && (data[7].length == 0 || data[7] ==='-'))
	{
	    return true;
	}
	

	return false;
    }  

    filter_qrjyz = (data, value) => {
	var data_qrjyz = parseFloat(data[10]);
	if(data[10] === null) {
	    data_qrjyz = 0;
	}
	if(data[10] === '-') {
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
	var data_inhouse = parseFloat(data[11]);
	if(data[11] === null) {
	    data_inhouse = 0;
	}
	if(data[11] === '-') {
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
	var count = 0;

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
		if(count <250) {
		    queryResult.push(record);
		}
		count++;
	    }
	}, this);

	var filters = {
	    gene_value: this.state.gene_value,
	    tblx_values: this.state.tblx_values,
	    tbbl_values: this.state.tbbl_values,
	    ycfs_values: this.state.ycfs_values,
	    cxsd_values: this.state.cxsd_values,
	    dm_values: this.state.dm_values,
	    qrjyz_value: this.state.qrjyz_values,
	    inhouse_value: this.state.inhouse_value,
	};
	this.setState({queryResult: queryResult, count: count}, () => {eh.emitEvent('filterchange', [JSON.stringify(filters)]);ReactTooltip.rebuild;});
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
    
    handleGeneClear = () => {
	this.setState({gene_value:""}, this.filter);
    };

    handleRowSelect = (rows) => {
	var temp = [];
	if(rows ==='all') {
	    for(var key in this.state.queryResult)
	    {
		tableData[this.state.queryResult[key][25]][26] = true;
		this.state.queryResult[key][26] = true;
	    }
	    this.setState({selected:this.state.queryResult}, this.filter);
	    return;
	}
	if(rows ==='none') {
	    for(var key in this.state.queryResult)
	    {
		tableData[this.state.queryResult[key][25]][26] = false;
		this.state.queryResult[key][26] = false;
	    }
	    this.setState({selected:[]}, this.filter);
	    return;
	}

	for(var i in tableData) {
	    tableData[i][26] = false;
	}
	for(var i in this.state.queryResult) {
	    this.state.queryResult[i][26] = false;
	}
	for(var i in rows) {
	    tableData[this.state.queryResult[rows[i]][25]][26] = true;
	    this.state.queryResult[rows[i]][26] = true;
	    temp.push(this.state.queryResult[rows[i]]);
	}
	this.setState({selected:temp}, this.filter);
    };

    handleFilterLoad = (filter) => {
	var filter = JSON.parse(filter);
	this.setState(filter, this.filter);
    }

    render() {
	return (
<MuiThemeProvider muiTheme={muiTheme}>
  <div>
    <ReactTooltip type="info" effect="float" multiline={true} />
    <div style={{width:'80%', marginLeft:'auto', marginRight:'auto'}}>
      <input type="text" placeholder="可输入重点关注基因"  value={this.state.gene_value} onChange={this.handle_gene_Change} style={{width:'80%'}}/>
      <FlatButton label="清除所有基因" primary={true} onClick={this.handleGeneClear}/>
    </div>
    <div id="carousel-filter" className="carousel slide" data-ride="carousel" data-interval="false">
      <div className="carousel-inner">
        <div className="item active">
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px', paddingBottom:'0px', color:'#00a65a'}}>
	    <span onMouseEnter={()=>{$('#tip').show();}}
	      onMouseLeave={()=>{$('#tip').hide();}}
	      onTouchStart={()=>{$('#tip').show();}}>精准推荐</span>
	    <i className="fa fa-fw fa-question"/>
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>
	    <div id='tip' className="callout callout-info" style={{display:'none'}}>
              <h4>精准推荐过滤说明！</h4>
              <p>优选1：筛选HGMD数据库已报道的突变点，是否有与临床表型相关基因突变<br/>
		优选2: 筛选四种通常会严重影响蛋白功能（LOF）的特殊突变类型<br/>
		★  经优选1和优选2筛选未发现疾病相关突变，则进入常规分析流程。<br/>
		方 案 一：按照遗传方式筛选；适用案例：适用于缺乏特异或典型临床表型的案例分析<br/>
		Step1：根据临床表型和家族史等，推测遗传方式（线粒体遗传除外），注意携带率的筛选<br/>
		Step2：在上述筛选过滤后的突变点中，综合基因疾病信息和功能预测综合筛选疑似突变点<br/>
		方 案 二：关联临床表型相关基因群，即临床表型驱动分析；<br/>
		适用案例：适用于患者存在有特异或典型症状体征<br/>
		Step1：关联临床诊断相关基因群（建议使用明鉴），并将基因群输入重点关注基因<br/>
		Step2：在重点关注基因范围内，参照方案一的筛选模式进行。<br/>
	      </p>
	    </div>
	      
	    <div>
	      <SingleSelectHGDM fullWidth={true} value={this.state.dm_values} floatingLabelText="HGMD" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"已报道"} value="1" />
		<ListItem primaryText={"未报道"} value="2" />
		<ListItem primaryText={"不筛选"} value="3" />
	      </SingleSelectHGDM>
	      <div id='tipdm' className="callout callout-info" style={{display:'none'}}>
		<h4>HGMD！</h4>
		<p>HGMD:  Human Gene Mutation Database，人类基因突变数据库<br/>
		  DM：文献报道过的致病突变。<br/>
		  DM？：表示致病性不肯定。<br/>
		  [Similar]DM: 与所报道的突变点的染色体位置一致，但突变类型与文献报道的不同。<br/>
		  DP：疾病相关的多态性，但没有直接证据证实此突变致病。<br/>
		  DFP：疾病相关的多态性，有直接证据证明此突变与蛋白功能有关。<br/>
		  FP：功能型多态性，被报道能影响蛋白结构，功能或基因表达，但无致病报道。<br/>
		</p>
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
	      <div id='tiptblx' className="callout callout-info" style={{display:'none'}}>
		<h4>突变类型！</h4>
		<p>1.stopgain：无义突变；splicing: 剪切突变；frameshift: 移码突变；stoploss: 终止密码突变<br/>
		  2.nonsynonymous: 错义突变；nonframshift: 非移码突变<br/>
		  3.synonymous: 同义突变；unknown: 不确定（此类型通常位于非外显子编码区）<br/>
		  建议：通常关注第一类包含的四种突变类型；第二类是最常见突变类型；第三类通常不查看<br/>
		</p>
	      </div>
	    </div>
	    <div>
	      <MultiSelectYCFS fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" className={"green_border"}/>
		<ListItem primaryText={"AD"} value="AD" className={"yellow_border"}/>
		<ListItem primaryText={"XR"} value="XR" className={"blue_border"}/>
		<ListItem primaryText={"XD"} value="XD" className={"blue_border"}/>
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" className={"blue_border"}/>
		<ListItem primaryText={"不明"} value="不明" className={"purple_border"}/>
		<ListItem primaryText={"不筛选"} value=""/>
	      </MultiSelectYCFS>
	      <div id='tipycfs' className="callout callout-info" style={{display:'none'}}>
		<h4>遗传方式！</h4>
		<p>AD: 常染色体显性遗传；AR：常染色体隐性遗传；<br/>
		  XD：X染色体显性遗传；XR：X染色体隐性遗传；X-Link：X染色体连锁；<br/>
		</p>
	      </div>
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
	  <div className="carousel-caption" style={{top:'0px', bottom: 'auto', paddingTop:'0px', paddingBottom:'0px', color:'#00a65a'}}>
	    自选过滤
	  </div>
	  <div style={{width:'80%', marginLeft:'auto', marginRight:'auto', paddingTop:'20px', overflow:'hidden'}}>

	    <div>
	      <SingleSelectHGDM fullWidth={true} value={this.state.dm_values} floatingLabelText="HGMD" onChange={this.handle_dm_Change}>
		<ListItem primaryText={"已报道"} value="1" />
		<ListItem primaryText={"未报道"} value="2" />
		<ListItem primaryText={"不筛选"} value="3" />
	      </SingleSelectHGDM>
	      <div id='tipdm' className="callout callout-info" style={{display:'none'}}>
		<h4>HGMD！</h4>
		<p>HGMD:  Human Gene Mutation Database，人类基因突变数据库<br/>
		  DM：文献报道过的致病突变。<br/>
		  DM？：表示致病性不肯定。<br/>
		  [Similar]DM: 与所报道的突变点的染色体位置一致，但突变类型与文献报道的不同。<br/>
		  DP：疾病相关的多态性，但没有直接证据证实此突变致病。<br/>
		  DFP：疾病相关的多态性，有直接证据证明此突变与蛋白功能有关。<br/>
		  FP：功能型多态性，被报道能影响蛋白结构，功能或基因表达，但无致病报道。<br/>
		</p>
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
	      <div id='tiptblx' className="callout callout-info" style={{display:'none'}}>
		<h4>突变类型！</h4>
		<p>1.stopgain：无义突变；splicing: 剪切突变；frameshift: 移码突变；stoploss: 终止密码突变<br/>
		  2.nonsynonymous: 错义突变；nonframshift: 非移码突变<br/>
		  3.synonymous: 同义突变；unknown: 不确定（此类型通常位于非外显子编码区）<br/>
		  建议：通常关注第一类包含的四种突变类型；第二类是最常见突变类型；第三类通常不查看<br/>
		</p>
	      </div>
	    </div>
	    <div>
	      <MultiSelectYCFS fullWidth={true} value={this.state.ycfs_values} floatingLabelText="遗传方式" onChange={this.handle_ycfs_Change}>
		<ListItem primaryText={"AR"} value="AR" className={"green_border"}/>
		<ListItem primaryText={"AD"} value="AD" className={"yellow_border"}/>
		<ListItem primaryText={"XR"} value="XR" className={"blue_border"}/>
		<ListItem primaryText={"XD"} value="XD" className={"blue_border"}/>
		<ListItem primaryText={"X-LINKED"} value="X-LINKED" className={"blue_border"}/>
		<ListItem primaryText={"不明"} value="不明" className={"purple_border"}/>
		<ListItem primaryText={"不筛选"} value=""/>
	      </MultiSelectYCFS>
	      <div id='tipycfs' className="callout callout-info" style={{display:'none'}}>
		<h4>遗传方式！</h4>
		<p>AD: 常染色体显性遗传；AR：常染色体隐性遗传；<br/>
		  XD：X染色体显性遗传；XR：X染色体隐性遗传；X-Link：X染色体连锁；<br/>
		</p>
	      </div>
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

        <a className="left carousel-control" style={{width:'5%'}} href="#carousel-filter" data-slide="prev">
          <span className="fa fa-angle-left" style={{color:'#0000FF'}}></span>
        </a>
        <a className="right carousel-control" style={{width:'5%'}} href="#carousel-filter" data-slide="next">
		<span className="fa fa-angle-right" style={{color:'#0000FF'}}></span>
        </a>
      </div>
      <Table
	 fixedHeader={true}
	 fixedFooter={this.state.fixedFooter}
	 selectable={false}
	 multiSelectable={false}
	 style={{backgroundColor:"lightblue"}}
	 >	
	<TableHeader
	   displaySelectAll={false}
	   adjustForCheckbox={false}
	   enableSelectAll={false}
	   >
	  <TableRow>
	    <TableHeaderColumn colSpan="8" style={{verticalAlign: 'bottom', fontWeight:'bold', fontSize:'120%', overflow:'hidden'}}>
	      我的选点(目前选中: {this.state.selected.length} 个)
	    </TableHeaderColumn>
	  </TableRow>
	  <TableRow>
	    <TableHeaderColumn data-tip="基因" style={{overflow:'hidden'}}>基因</TableHeaderColumn>
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
	   displayRowCheckbox={false}
	   deselectOnClickaway={false}
	   showRowHover={this.state.showRowHover}
	   stripedRows={this.state.stripedRows}
	   >
	  {this.state.selected.map( (row, index) => (
	  <TableRow key={index}>
	    <TableRowColumn data-tip={row[0]} style={{position:'relative'}}>{row[0]}</TableRowColumn>//基因
	    <TableRowColumn data-tip={row[21]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[21]}} />//突变信息
	    <TableRowColumn data-tip={row[6]} style={{position:'relative'}}>{row[6]}</TableRowColumn>//突变类型
	    <TableRowColumn data-tip={row[19]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[19]}} />//疾病信息
	    <TableRowColumn data-tip={row[22]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[22]}} />//HET
	    <TableRowColumn data-tip={row[24]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[24]}} />//HGDM
	    <TableRowColumn data-tip={row[23]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[23]}} />//正常人群携带率
	    <TableRowColumn data-tip={row[20]} style={{position:'relative'}}><a>详情</a></TableRowColumn>//功能预测
	  </TableRow>
	  ))}
	</TableBody>
      </Table>
      
      <Table
	 height={this.state.height}
	 fixedHeader={this.state.fixedHeader}
	 fixedFooter={this.state.fixedFooter}
	 selectable={this.state.selectable}
	 multiSelectable={this.state.multiSelectable}
	 onRowSelection={this.handleRowSelect}
	 className="result"
	 >	
	<TableHeader
	   displaySelectAll={this.state.showCheckboxes}
	   adjustForCheckbox={this.state.adjustForCheckboxes}
	   enableSelectAll={this.state.enableSelectAll}
	   >
	  <TableRow>
		<TableHeaderColumn colSpan="4" style={{verticalAlign: 'bottom', fontWeight:'bold', fontSize:'120%', overflow:'hidden'}} data-tip={"当前选择：" +this.state.count +'/'+tableData.length+"(筛选/全部)"}>当前选择：{this.state.count} /{tableData.length}(筛选/全部)
	    </TableHeaderColumn>
	    <TableHeaderColumn  colSpan="3" style={{verticalAlign: 'bottom', textAlign:'right'}}>
	      <a id='export' data-type="xls" href="javascript:;" style={{color: 'blue', overflow:'hidden'}}>下载过滤结果</a>
	    </TableHeaderColumn>
	  </TableRow>
	  <TableRow>
	    <TableHeaderColumn data-tip="基因" style={{overflow:'hidden'}}>基因</TableHeaderColumn>
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
	  <TableRow key={index} selected={row[26]}>
	    <TableRowColumn data-tip={row[0]} style={{position:'relative'}}>{row[0]}</TableRowColumn>//基因
	    <TableRowColumn data-tip={row[21]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[21]}} />//突变信息
	    <TableRowColumn data-tip={row[6]} style={{position:'relative'}}>{row[6]}</TableRowColumn>//突变类型
	    <TableRowColumn data-tip={row[19]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[19]}} />//疾病信息
	    <TableRowColumn data-tip={row[22]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[22]}} />//HET
	    <TableRowColumn data-tip={row[24]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[24]}} />//HGDM
	    <TableRowColumn data-tip={row[23]} style={{position:'relative'}} dangerouslySetInnerHTML={{__html: row[23]}} />//正常人群携带率
	    <TableRowColumn data-tip={row[20]} style={{position:'relative'}}><a>详情</a></TableRowColumn>//功能预测
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
