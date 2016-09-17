import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from 'material-ui/Table';
import TextField from 'material-ui/TextField';
import Toggle from 'material-ui/Toggle';
import {deepOrange500} from 'material-ui/styles/colors';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import ListItem from 'material-ui/List';
import ReactTooltip from 'react-tooltip';
import Toolbarfilter from './toolbar';
import DropDownMenu from 'material-ui/DropDownMenu';
import MenuItem from 'material-ui/MenuItem';
import Checkbox from 'material-ui/Checkbox';
import MultiSelect from './multiselect';
import SelectField from 'material-ui/SelectField';
import RaisedButton from 'material-ui/RaisedButton';

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
	this.state = {
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
		"0-10",
		"10-25",
		"25-50",
		"50-100",
		"100+"
	    ],
	    dm_values: [
		"DM",
		"DM?",
		"other",
	    ],
	    rqpl_value:"%1",
	    qrjyz_value:"%1",
	    oz6500_value:"%1",
	    inhouse_value:"%1",
	};	
    }


    rqpl_items = [
	    <MenuItem key={1} value={"%1"} primaryText="%1" />,
	    <MenuItem key={2} value={"%2"} primaryText="2%" />,
    ];

    filter_gene = (data, value) => {
	var keywords = this.state.gene_value.split(/\s+/);
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
	    for(var j in data[20]) {
		if(data[20][j].toLowerCase() === this.state.ycfs_values[i].toLowerCase()) {
		    return true
		}
	    }	    
	}

	return false;
    }

    filter_tbbl = (data, value) => {
	return true;
    }  

    filter_cxsd = (data, value) => {
	return true;
    }  

    filter_dm = (data, value) => {
	return true;
    }  

    filter_rqpl = (data, value) => {
	return true;
    }  

    filter_qrjyz = (data, value) => {
	return true;
    }

    filter_oz6500 = (data, value) => {
	return true;
    }  

    filter_inhouse = (data, value) => {
	return true;
    }

    filters = [
	this.filter_gene,
	this.filter_tblx,
	this.filter_ycfs,
	this.filter_tbbl,
	this.filter_cxsd,
	this.filter_dm,
	this.filter_rqpl,
	this.filter_qrjyz,
	this.filter_oz6500,
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
	this.setState({gene_value:  event.target.value});
    };

    handle_tblx_Change = (e,v) => {
	this.setState({tblx_values: v});
    };

    handle_tbbl_Change = (e,v) => {
	this.setState({tbbl_values: v});
    };

    handle_ycfs_Change = (e,v) => {
	this.setState({ycfs_values: v});
    };

    handle_cxsd_Change = (e,v) => {
	this.setState({cxsd_values: v});
    };

    handle_dm_Change = (e,v) => {
	this.setState({dm_values: v});
    };

    handle_rqpl_Change = (event, index, value) => {
	this.setState({rqpl_value: value});
    };

    handle_qrjyz_Change = (event, index, value) => {
	this.setState({qrjyz_value: value});
    };
    
    handle_oz6500_Change = (event, index, value) => {
	this.setState({oz6500_value: value});
    };

    handle_inhouse_Change = (event, index, value) => {
	this.setState({inhouse_value: value});
    };

    handleRowHover = (row) => {
	ReactTooltip.rebuild();
    };
    
    render() {
	for(var key in tableData) {
	    //疾病信息
	    var str = '';
	    for(var inkey in tableData[key][21]) {
		if(tableData[key][21][inkey]) {
		    str = str.concat(tableData[key][21][inkey][0], '--', tableData[key][21][inkey][1], '--', tableData[key][21][inkey][2], '<br/>');
		}
	    }
	    tableData[key].push(str);

	    //HET tooltip
	    var str = '';
	    str = str.concat(tableData[key][8], '<br/>',
			     tableData[key][9], '<br/>',
			     tableData[key][10], '<br/>',
			     tableData[key][11], '<br/>',
			     tableData[key][12]
			    );
	    tableData[key].push(str);

	    //突变信息
	    var str = '';
	    str = tableData[key][1].replace(/\s/g, '<br/>');
	    tableData[key].push(str);
	}
	
	return (
<MuiThemeProvider muiTheme={muiTheme}>
  <div>
    <ReactTooltip type="info" effect="float" multiline={true}/>
	    
    <Table
       height={this.state.height}
       fixedHeader={this.state.fixedHeader}
       fixedFooter={this.state.fixedFooter}
       selectable={this.state.selectable}
       multiSelectable={this.state.multiSelectable}
       onRowHover = {this.handleRowHover}
       >
      <TableHeader
	 displaySelectAll={this.state.showCheckboxes}
	 adjustForCheckbox={this.state.adjustForCheckboxes}
	 enableSelectAll={this.state.enableSelectAll}
	 >
	<TableRow>
	  <TableHeaderColumn colSpan="7" tooltip="诊断过滤工具" style={{textAlign: 'center'}}>
	    诊断过滤工具
	  </TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn colSpan="4"><TextField name='gene' floatingLabelText="基因" defaultValue={this.state.gene_value} fullWidth={true} onChange={this.handle_gene_Change}/></TableHeaderColumn>
	  <TableHeaderColumn>突变类型</TableHeaderColumn>
	  <TableHeaderColumn colSpan="2">
	    <MultiSelect fullWidth={true} value={this.state.tblx_values} onChange={this.handle_tblx_Change}>
	      <ListItem primaryText={"frameshift"} value="frameshift" />
	      <ListItem primaryText={"nonframeshift"} value="nonframeshift" />
	      <ListItem primaryText={"nonsynonymous"} value="nonsynonymous" />
	      <ListItem primaryText={"splicing"} value="splicing" />
	      <ListItem primaryText={"stopgain"} value="stopgain" />
	      <ListItem primaryText={"synonymous"} value="synonymous" />
	      <ListItem primaryText={"stoploss"} value="stoploss" />
	      <ListItem primaryText={"unknown"} value="unknown" />
	    </MultiSelect>
	  </TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn>突变比例</TableHeaderColumn>
	  <TableHeaderColumn colSpan="2">
		<MultiSelect fullWidth={true} value={this.state.tbbl_values} onChange={this.handle_tbbl_Change}>
	      <ListItem primaryText={"0.9-1"} value="0.9-1" />
	      <ListItem primaryText={"0.75-0.9"} value="0.75-0.9" />
	      <ListItem primaryText={"0.65-0.75"} value="0.65-0.75" />
	      <ListItem primaryText={"0.35-0.65"} value="0.35-0.65" />
	      <ListItem primaryText={"0.2-0.35"} value="0.2-0.35" />
	      <ListItem primaryText={"0-0.2"} value="0-0.2" />
	    </MultiSelect>
	  </TableHeaderColumn>
	  <TableHeaderColumn>遗传方式</TableHeaderColumn>
	  <TableHeaderColumn colSpan="2">
	    <MultiSelect fullWidth={true} value={this.state.ycfs_values} onChange={this.handle_ycfs_Change}>
	      <ListItem primaryText={"AR"} value="AR" />
	      <ListItem primaryText={"AD"} value="AD" />
	      <ListItem primaryText={"XR"} value="XR" />
	      <ListItem primaryText={"XD"} value="XD" />
	      <ListItem primaryText={"X-LINKED"} value="X-LINKED" />
	    </MultiSelect>
	  </TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn>测序深度</TableHeaderColumn>
	  <TableHeaderColumn colSpan="2">
	    <MultiSelect fullWidth={true} value={this.state.cxsd_values} onChange={this.handle_cxsd_Change}>
	      <ListItem primaryText={"0-10"} value="0-10" />
	      <ListItem primaryText={"10-25"} value="10-25" />
	      <ListItem primaryText={"25-50"} value="25-50" />
	      <ListItem primaryText={"50-100"} value="50-100" />
	      <ListItem primaryText={"100+"} value="100+" />
	    </MultiSelect>
	  </TableHeaderColumn>
	  <TableHeaderColumn>DM/其它</TableHeaderColumn>
	  <TableHeaderColumn colSpan="2">
	    <MultiSelect fullWidth={true} value={this.state.dm_values} onChange={this.handle_dm_Change}>
	      <ListItem primaryText={"DM"} value="DM" />
	      <ListItem primaryText={"DM?"} value="DM?" />
	      <ListItem primaryText={"其它"} value="other" />
	    </MultiSelect>
	  </TableHeaderColumn>	  
	</TableRow>
	<TableRow>
	  <TableHeaderColumn>
	    <SelectField
	       fullWidth={true}
	       value={this.state.rqpl_value}
	       onChange={this.handle_rqpl_Change}
	      floatingLabelText="人群频率"
	      >
	      {this.rqpl_items}
	    </SelectField>
	  </TableHeaderColumn>
	  <TableHeaderColumn>
	    <SelectField
	       fullWidth={true}
	       value={this.state.qrjyz_value}
	       onChange={this.handle_qrjyz_Change}
	      floatingLabelText="千人基因组"
	      >
	      {this.rqpl_items}
	    </SelectField>
	  </TableHeaderColumn>
	  <TableHeaderColumn>
	    <SelectField
	       fullWidth={true}
	       value={this.state.oz6500_value}
	       onChange={this.handle_oz6500_Change}
	      floatingLabelText="欧洲6500"
	      >
	      {this.rqpl_items}
	    </SelectField>
	  </TableHeaderColumn>
	  <TableHeaderColumn>
	    <SelectField
	       fullWidth={true}
	       value={this.state.inhouse_value}
	       onChange={this.handle_inhouse_Change}
	      floatingLabelText="inhouse"
	      >
	      {this.rqpl_items}
	    </SelectField>
	  </TableHeaderColumn>
	  <TableHeaderColumn>
	    <RaisedButton label="过滤" primary={true} onClick={this.filter}/>
	  </TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn tooltip="基因">基因</TableHeaderColumn>
	  <TableHeaderColumn tooltip="大小">大小</TableHeaderColumn>
	  <TableHeaderColumn tooltip="突变信息">突变信息</TableHeaderColumn>
	  <TableHeaderColumn tooltip="突变类型">突变类型</TableHeaderColumn>
	  <TableHeaderColumn tooltip="HGDM信息">HGDM</TableHeaderColumn>
	  <TableHeaderColumn tooltip="基因疾病信息">基因疾病信息</TableHeaderColumn>
	  <TableHeaderColumn tooltip="HET信息">HET</TableHeaderColumn>
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
	  <TableRowColumn data-tip={row[0]}>{row[0]}</TableRowColumn>//基因
	  <TableRowColumn data-tip={row[19]}>{row[19]}</TableRowColumn>//大小
	  <TableRowColumn data-tip={row[24]}>{row[24]}</TableRowColumn>//突变信息
	  <TableRowColumn data-tip={row[5]}>{row[5]}</TableRowColumn>//突变类型
	  <TableRowColumn data-tip='数据中无此项'>无数据</TableRowColumn>//HGDM

	  //疾病信息
	  <TableRowColumn data-tip={row[22]}>{row[22]}</TableRowColumn>

	  <TableRowColumn data-tip={row[23]}>{row[15].NG16070056[1]}</TableRowColumn>//HET
	</TableRow>
	))}
      </TableBody>
    </Table>
  </div>
</MuiThemeProvider>
	);
    }
}
